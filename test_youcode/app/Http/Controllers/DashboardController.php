<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::withCount('attempts')
            ->withAvg('attempts', 'score')
            ->latest()
            ->get();

        return view('dashboard', compact('quizzes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'passing_score' => 'required|integer|between:0,100'
        ]);

        Quiz::create($validated);

        return redirect()->route('quizzes.index')
            ->with('success', 'Quiz créé avec succès');
    }

    public function show(Quiz $quiz)
    {
        return response()->json($quiz);
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'duration' => 'required|integer|min:1',
            'passing_score' => 'required|integer|between:0,100'
        ]);

        $quiz->update($validated);

        return redirect()->route('quizzes.index')
            ->with('success', 'Quiz mis à jour avec succès');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizzes.index')
            ->with('success', 'Quiz supprimé avec succès');
    }

    public function dashboard()
    {
        // Get statistics
        $stats = [
            'totalStudents' => User::where('role_id', Role::where('name', 'student')->first()->id ?? 0)->count(),
            'completedQuizzes' => QuizAttempt::count(),
            'totalQuizzes' => Quiz::count(),
            'activeStaff' => User::whereIn('role_id', Role::whereIn('name', ['staff', 'admin'])->pluck('id'))->where('is_active', true)->count(),
        ];

        // Get quizzes with attempt statistics
        $quizzes = Quiz::leftJoin('quiz_attempts', 'quizzes.id', '=', 'quiz_attempts.quiz_id')
            ->select(
                'quizzes.*',
                DB::raw('COUNT(quiz_attempts.id) as attempts_count'),
                DB::raw('AVG(quiz_attempts.score) as attempts_avg_score')
            )
            ->groupBy('quizzes.id')
            ->get();

        return view('dashboard', compact('stats', 'quizzes'));
    }
}