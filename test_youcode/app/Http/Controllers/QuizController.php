<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('is_active', true)->get();
        return view('quiz.index', compact('quizzes'));
    }

    public function start($id = null)
    {
        // Get the first active quiz if ID not specified
        $quiz = $id ? Quiz::findOrFail($id) : Quiz::where('is_active', true)->first();
        
        if (!$quiz) {
            return redirect()->route('dashboard')->with('error', 'No active quizzes available.');
        }

        // Get questions with pagination
        $questions = Question::where('quiz_id', $quiz->id)
            ->with('options')
            ->paginate(5); // 5 questions per page

        // Initialize quiz session
        session(['quiz_start_time' => now(), 'quiz_id' => $quiz->id]);
        
        // Get any saved answers from session
        $savedAnswers = session('quiz_answers', []);

        return view('quizzes', compact('quiz', 'questions', 'savedAnswers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'answers' => 'required|array',
            'answers.*' => 'required|exists:options,id',
        ]);

        // Store answers in session
        $currentAnswers = session('quiz_answers', []);
        $newAnswers = $request->input('answers', []);
        $mergedAnswers = array_merge($currentAnswers, $newAnswers);
        session(['quiz_answers' => $mergedAnswers]);

        if ($request->input('action') === 'finish') {
            return $this->processQuizSubmission($request);
        }

        // Get the next page
        $nextPage = $request->input('current_page') + 1;

        // Redirect to the next page
        return redirect()->route('quiz.start', ['page' => $nextPage]);
    }

    private function processQuizSubmission(Request $request)
    {
        $answers = session('quiz_answers', []);
        $quizId = $request->input('quiz_id');
        $quiz = Quiz::findOrFail($quizId);

        // Calculate score
        $correctAnswers = 0;
        $totalQuestions = count($answers);

        foreach ($answers as $questionId => $optionId) {
            $option = Option::find($optionId);
            if ($option && $option->is_correct) {
                $correctAnswers++;
            }
        }

        $score = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;
        $isPassing = $score >= $quiz->passing_score;

        // Save the quiz attempt
        QuizAttempt::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'score' => $score,
            'passed' => $isPassing,
            'answers' => json_encode($answers),
            'completed_at' => now(),
        ]);

        // Clear session
        session()->forget('quiz_answers');

        return redirect()->route('quiz.result')->with([
            'score' => $score,
            'totalQuestions' => $totalQuestions,
            'correctAnswers' => $correctAnswers,
            'isPassing' => $isPassing,
            'passingScore' => $quiz->passing_score,
        ]);
    }

    public function result()
    {
        if (!session()->has('score')) {
            return redirect()->route('dashboard');
        }

        return view('quiz.result', [
            'score' => session('score'),
            'totalQuestions' => session('totalQuestions'),
            'correctAnswers' => session('correctAnswers'),
            'isPassing' => session('isPassing'),
            'passingScore' => session('passingScore'),
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
}