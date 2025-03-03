<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;

class AdminQuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::withCount(['questions', 'attempts'])->get();
        return view('admin.quizzes.index', compact('quizzes'));
    }
    
    public function create()
    {
        return view('admin.quizzes.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'passing_score' => 'required|integer|min:0|max:100',
            'is_active' => 'boolean'
        ]);
        
        Quiz::create($validated);
        
        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz created successfully.');
    }
    
    public function edit(Quiz $quiz)
    {
        return view('admin.quizzes.edit', compact('quiz'));
    }
    
    public function update(Request $request, Quiz $quiz)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'passing_score' => 'required|integer|min:0|max:100',
            'is_active' => 'boolean'
        ]);
        
        $quiz->update($validated);
        
        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz updated successfully.');
    }
    
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        
        return redirect()->route('admin.quizzes.index')
            ->with('success', 'Quiz deleted successfully.');
    }
    
    public function questions(Quiz $quiz)
    {
        $questions = $quiz->questions()->with('options')->get();
        return view('admin.quizzes.questions', compact('quiz', 'questions'));
    }
    
    public function results()
    {
        $attempts = QuizAttempt::with(['user', 'quiz'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('admin.quizzes.results', compact('attempts'));
    }
}