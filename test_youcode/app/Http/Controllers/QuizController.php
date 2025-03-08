<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Option;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('is_published', true)
            ->orderBy('title')
            ->get();
            
        return view('quiz.index', compact('quizzes'));
    }
    
    public function start(Request $request)
    {
        if ($request->has('token')) {
            try {
                $quizId = decrypt($request->token);
                
                $quiz = Quiz::findOrFail($quizId);
                
                if (!$this->canTakeQuiz($quiz)) {
                    return redirect()->route('quiz.index')
                        ->with('error', 'Vous n\'êtes pas autorisé à prendre ce quiz.');
                }
            } catch (\Throwable $th) {
                return redirect()->route('quiz.index')
                    ->with('error', 'Quiz token invalide ou expiré.');
            }
        } 
        else {
            $availableQuizzes = Quiz::where('is_published', true)
                ->whereDoesntHave('attempts', function($query) {
                    $query->where('user_id', Auth::id())
                        ->where('passed', true);
                })
                ->get();
                
            if ($availableQuizzes->isEmpty()) {
                return redirect()->route('quiz.index')
                    ->with('info', 'Aucun quiz disponible pour le moment.');
            }
            
            $quiz = $availableQuizzes->random();
        }
        
        session(['active_quiz_id' => $quiz->id]);
        
        $questions = $quiz->questions()->paginate(1);
        
        return view('quizzes', compact('quiz', 'questions'));
    }
    
    public function generateQuizToken($quizId)
    {
        return encrypt($quizId);
    }
    
    public function show(Request $request)
    {
        if ($request->has('id')) {
            $quiz = Quiz::findOrFail($request->id);
            
            if (!$this->canTakeQuiz($quiz)) {
                return redirect()->route('quiz.index')
                    ->with('error', 'Vous n\'êtes pas autorisé à prendre ce quiz.');
            }
            
            $token = $this->generateQuizToken($quiz->id);
            
            return view('quiz.show', compact('quiz', 'token'));
        }
        
        return view('quiz.random');
    }
    
    private function canTakeQuiz($quiz)
    {
        if (!$quiz->is_published) {
            return false;
        }
        
        $userAttempts = QuizAttempt::where('user_id', Auth::id())
            ->where('quiz_id', $quiz->id)
            ->count();
            
        if ($quiz->max_attempts > 0 && $userAttempts >= $quiz->max_attempts) {
            return false;
        }
        
        return true;
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'current_page' => 'required|integer',
            'action' => 'required|in:next,finish,timeout',
        ]);

        $quizId = $request->quiz_id;
        $currentPage = $request->current_page;
        $action = $request->action;

        if ($request->has('answers')) {
            $currentAnswers = session('quiz_answers', []);
            $newAnswers = $request->answers;

            session(['quiz_answers' => array_merge($currentAnswers, $newAnswers)]);
        }

        if ($action === 'finish' || $action === 'timeout') {

            $allAnswers = session('quiz_answers', []);

            $submitRequest = new Request([
                'quiz_id' => $quizId,
                'answers' => $allAnswers,
            ]);

            session()->forget('quiz_answers');

            return app()->call([$this, 'submit'], ['request' => $submitRequest]);
        }

        return redirect()->route('quiz.start', [
            'id' => $quizId,
            'page' => $currentPage + 1,
        ]);
    }

    public function userAttempts()
    {
        $attempts = QuizAttempt::where('user_id', Auth::id())
            ->with('quiz')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('quiz.attempts', compact('attempts'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'answers' => 'required|array',
            'answers.*' => 'required|exists:options,id',
        ]);

        $quiz = Quiz::findOrFail($request->quiz_id);
        $user = Auth::user();
        $answers = $request->answers;

        $correctAnswers = 0;
        $totalQuestions = 0;

        foreach ($quiz->questions as $question) {
            $totalQuestions++;

            if (isset($answers[$question->id])) {
                $selectedOptionId = $answers[$question->id];
                $isCorrect = Option::where('id', $selectedOptionId)
                    ->where('question_id', $question->id)
                    ->where('is_correct', true)
                    ->exists();

                if ($isCorrect) {
                    $correctAnswers++;
                }
            }
        }

        $score = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;

        $passed = $score >= $quiz->passing_score;

        $attempt = QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => $score,
            'answers' => json_encode($answers),
            'passed' => $passed,
            'completed_at' => now(),
        ]);

        return redirect()->route('quiz.results', $attempt->id)
            ->with('success', 'Quiz complété avec succès!');
    }

    public function showResults(QuizAttempt $attempt)
    {
        if (Auth::id() !== $attempt->user_id && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        $attempt->load(['quiz.questions.options']);

        return view('quiz.results', compact('attempt'));
    }
}