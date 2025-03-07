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
            ->paginate(4); // 5 questions per page

        // Initialize quiz session
        session(['quiz_start_time' => now(), 'quiz_id' => $quiz->id]);

        // Get any saved answers from session
        $savedAnswers = session('quiz_answers', []);

        return view('quizzes', compact('quiz', 'questions', 'savedAnswers'));
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'duration_minutes' => 'required|integer|min:1',
    //         'passing_score' => 'required|integer|between:0,100',
    //     ]);

    //     // Let the database assign the ID automatically
    //     $quiz = new Quiz();
    //     $quiz->title = $validated['title'];
    //     $quiz->description = $validated['description'];
    //     $quiz->duration_minutes = $validated['duration_minutes'];
    //     $quiz->passing_score = $validated['passing_score'];
    //     $quiz->save();

    //     return redirect()->route('dashboard')->with('success', 'Quiz créé avec succès.');
    // }

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

        // Store the answers in the session
        if ($request->has('answers')) {
            $currentAnswers = session('quiz_answers', []);
            $newAnswers = $request->answers;

            // Merge with existing answers
            session(['quiz_answers' => array_merge($currentAnswers, $newAnswers)]);
        }

        // If finishing the quiz, submit all answers
        if ($action === 'finish' || $action === 'timeout') {
            // Get all saved answers
            $allAnswers = session('quiz_answers', []);

            // Create a new request with all answers
            $submitRequest = new Request([
                'quiz_id' => $quizId,
                'answers' => $allAnswers,
            ]);

            // Clear the session data
            session()->forget('quiz_answers');

            // Call submit method
            return app()->call([$this, 'submit'], ['request' => $submitRequest]);
        }

        // Otherwise go to next page
        return redirect()->route('quiz.start', [
            'id' => $quizId,
            'page' => $currentPage + 1,
        ]);
    }

    // public function submit(Request $request)
    // {
    //     $request->validate([
    //         'quiz_id' => 'required|exists:quizzes,id',
    //         'answers' => 'sometimes|array',
    //         'answers.*' => 'sometimes|exists:options,id',
    //         'action' => 'sometimes|string',
    //     ]);

    //     $quiz = Quiz::findOrFail($request->quiz_id);
    //     $user = Auth::user();
    //     $answers = $request->answers ?? [];

    //     // Handle if this was a timeout submission
    //     $wasTimeout = $request->action === 'timeout';

    //     // Calculate the score
    //     $correctAnswers = 0;
    //     $totalQuestions = $quiz->questions()->count();
    //     $answeredQuestions = 0;

    //     foreach ($quiz->questions()->with('options')->get() as $question) {
    //         // Skip if question was not answered
    //         if (!isset($answers[$question->id])) {
    //             continue;
    //         }

    //         $answeredQuestions++;
    //         $selectedOptionId = $answers[$question->id];

    //         // Check if selected option is correct
    //         $isCorrect = $question->options()
    //             ->where('id', $selectedOptionId)
    //             ->where('is_correct', true)
    //             ->exists();

    //         if ($isCorrect) {
    //             $correctAnswers++;
    //         }
    //     }

    //     // Calculate percentage score based on all questions, not just answered ones
    //     $score = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;

    //     // Determine if passed based on quiz passing score
    //     $passed = $score >= $quiz->passing_score;

    //     // Create attempt record
    //     $attempt = QuizAttempt::create([
    //         'user_id' => $user->id,
    //         'quiz_id' => $quiz->id,
    //         'score' => $score,
    //         'answers' => $answers,
    //         'passed' => $passed,
    //         'completed_at' => now(),
    //         'timed_out' => $wasTimeout,
    //     ]);

    //     // Clear any localStorage timer data for this quiz
    //     return redirect()->route('quiz.results', $attempt->id)
    //         ->with('success', $wasTimeout
    //             ? 'Le temps est écoulé. Votre quiz a été soumis automatiquement.'
    //             : 'Quiz complété avec succès!');
    // }

    // public function result()
    // {
    //     if (!session()->has('score')) {
    //         return redirect()->route('dashboard');
    //     }

    //     return view('quiz.result', [
    //         'score' => session('score'),
    //         'totalQuestions' => session('totalQuestions'),
    //         'correctAnswers' => session('correctAnswers'),
    //         'isPassing' => session('isPassing'),
    //         'passingScore' => session('passingScore'),
    //     ]);
    // }
    // public function submit(Request $request)
    // {
    //     $request->validate([
    //         'quiz_id' => 'required|exists:quizzes,id',
    //         'answers' => 'required|array',
    //         'answers.*' => 'required|integer|exists:options,id',
    //     ]);

    //     $quiz = Quiz::with(['questions.options' => function($query) {
    //         $query->where('is_correct', true);
    //     }])->findOrFail($request->quiz_id);
        
    //     $user = Auth::user();
    //     $answers = $request->answers;
        
    //     // Calculate the score
    //     $correctAnswers = 0;
    //     $totalQuestions = $quiz->questions->count();
        
    //     foreach ($quiz->questions as $question) {
    //         if (isset($answers[$question->id])) {
    //             $selectedOptionId = $answers[$question->id];
    //             $correctOption = $question->options->first();
                
    //             if ($correctOption && $selectedOptionId == $correctOption->id) {
    //                 $correctAnswers++;
    //             }
    //         }
    //     }
        
    //     // Calculate percentage score
    //     $score = $totalQuestions > 0 ? ($correctAnswers / $totalQuestions) * 100 : 0;
        
    //     // Determine if passed
    //     $passed = $score >= $quiz->passing_score;
        
    //     // Create attempt record
    //     $attempt = QuizAttempt::create([
    //         'user_id' => $user->id,
    //         'quiz_id' => $quiz->id,
    //         'score' => $score,
    //         'passed' => $passed,
    //         'answers' => json_encode($answers),
    //         'completed_at' => now(),
    //     ]);
        
    //     return redirect()->route('quiz.results', $attempt);
    // }
    
    // /**
    //  * Show quiz results
    //  */
    // public function showResults(QuizAttempt $attempt)
    // {
    //     // Ensure the user can only see their own results unless they're an admin
    //     if ($attempt->user_id !== auth()->id() && !auth()->user()->hasRole('admin')) {
    //         abort(403);
    //     }
        
    //     $attempt->load(['quiz.questions.options']);
        
    //     return view('quiz.results', compact('attempt'));
    // }

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