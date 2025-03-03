<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttemptController extends Controller
{
    public function index()
    {
        $attempts = QuizAttempt::where('user_id', Auth::id())
            ->with('quiz')
            ->latest()
            ->paginate(10);
            
        return view('attempts.index', compact('attempts'));
    }
    
    public function show(QuizAttempt $attempt)
    {
        // Check if the user is authorized to view this attempt
        if (Auth::id() != $attempt->user_id && !Auth::user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Non autorisé.');
        }
        
        $attempt->load(['quiz.questions.options']);
        
        return view('attempts.show', compact('attempt'));
    }
}