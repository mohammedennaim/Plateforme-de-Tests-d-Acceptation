<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizQuestionController extends Controller
{
    /**
     * Display all questions for a specific quiz.
     */
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->with('options')->get();
        return view('quiz.questions.index', compact('quiz', 'questions'));
    }

    /**
     * Show form to create a new question for a quiz.
     */
    public function create(Quiz $quiz)
    {
        return view('quiz.questions.create', compact('quiz'));
    }

    /**
     * Store a newly created question.
     */
    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'correct_option' => 'required|integer|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Create question
            $question = $quiz->questions()->create([
                'content' => $request->content,
            ]);

            // Create options
            foreach ($request->options as $index => $optionContent) {
                $question->options()->create([
                    'content' => $optionContent,
                    'is_correct' => $index == $request->correct_option,
                ]);
            }

            DB::commit();
            return redirect()->route('quiz.questions.index', $quiz)
                ->with('success', 'Question créée avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erreur lors de la création de la question: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Show the form for editing a question.
     */
    public function edit(Quiz $quiz, Question $question)
    {
        // Verify this question belongs to this quiz
        if ($question->quiz_id != $quiz->id) {
            return redirect()->route('quiz.questions.index', $quiz)
                ->with('error', 'Cette question n\'appartient pas à ce quiz.');
        }

        $options = $question->options;
        $correctOptionIndex = $options->search(function($option) {
            return $option->is_correct;
        });

        return view('quiz.questions.edit', compact('quiz', 'question', 'options', 'correctOptionIndex'));
    }

    /**
     * Update the specified question.
     */
    public function update(Request $request, Quiz $quiz, Question $question)
    {
        // Verify this question belongs to this quiz
        if ($question->quiz_id != $quiz->id) {
            return redirect()->route('quiz.questions.index', $quiz)
                ->with('error', 'Cette question n\'appartient pas à ce quiz.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string|max:255',
            'correct_option' => 'required|integer|min:0',
        ]);

        DB::beginTransaction();

        try {
            // Update question
            $question->update([
                'content' => $request->content,
            ]);

            // Delete existing options
            $question->options()->delete();

            // Create new options
            foreach ($request->options as $index => $optionContent) {
                $question->options()->create([
                    'content' => $optionContent,
                    'is_correct' => $index == $request->correct_option,
                ]);
            }

            DB::commit();
            return redirect()->route('quiz.questions.index', $quiz)
                ->with('success', 'Question mise à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erreur lors de la mise à jour de la question: ' . $e->getMessage())
                        ->withInput();
        }
    }

    /**
     * Remove the specified question.
     */
    public function destroy(Quiz $quiz, Question $question)
    {
        // Verify this question belongs to this quiz
        if ($question->quiz_id != $quiz->id) {
            return redirect()->route('quiz.questions.index', $quiz)
                ->with('error', 'Cette question n\'appartient pas à ce quiz.');
        }

        try {
            // Delete all options first
            $question->options()->delete();
            // Then delete the question
            $question->delete();
            
            return redirect()->route('quiz.questions.index', $quiz)
                ->with('success', 'Question supprimée avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression de la question: ' . $e->getMessage());
        }
    }
    
    /**
     * Get question details for AJAX request.
     */
    public function show(Question $question)
    {
        return response()->json($question->load('options'));
    }
}