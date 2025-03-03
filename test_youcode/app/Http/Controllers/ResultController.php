<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function index()
    {
        $attempt = QuizAttempt::where('user_id', Auth::id())
            ->with(['quiz', 'user'])
            ->latest()
            ->first();
            
        if (!$attempt) {
            return redirect()->route('dashboard')
                ->with('error', 'No quiz results found.');
        }
            
        return view('quiz.result', compact('attempt'));
    }
    
    public function show($id)
    {
        $attempt = QuizAttempt::findOrFail($id);
        
        // Check if user is authorized to view this attempt
        if (Auth::id() !== $attempt->user_id && !Auth::user()->hasRole('admin')) {
            return redirect()->route('dashboard')
                ->with('error', 'Unauthorized access.');
        }
        
        $quiz = $attempt->quiz;
        $answers = $attempt->answers;
        $questions = $quiz->questions()->with('options')->get();
        
        return view('quiz.review', compact('attempt', 'quiz', 'answers', 'questions'));
    }
}