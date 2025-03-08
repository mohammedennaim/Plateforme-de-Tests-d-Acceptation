<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizQuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->with('options')->get();
        return view('quiz.questions.index', compact('quiz', 'questions'));
    }

    public function create(Quiz $quiz)
    {
        return view('quiz.questions.create', compact('quiz'));
    }

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
            $question = $quiz->questions()->create([
                'content' => $request->content,
            ]);
            
            foreach ($request->options as $index => $optionContent) {
                $question->options()->create([
                    'content' => $optionContent,
                    'is_correct' => (int)$index === (int)$request->correct_option,
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

    public function edit(Quiz $quiz, Question $question)
    {
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
    
    public function update(Request $request, Quiz $quiz, Question $question)
    {
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
            $question->update([
                'content' => $request->content,
            ]);

            $question->options()->delete();
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

    public function destroy(Quiz $quiz, Question $question)
    {
        if ($question->quiz_id != $quiz->id) {
            return redirect()->route('quiz.questions.index', $quiz)
                ->with('error', 'Cette question n\'appartient pas à ce quiz.');
        }

        try {
            $question->options()->delete();
            $question->delete();
            
            return redirect()->route('quiz.questions.index', $quiz)
                ->with('success', 'Question supprimée avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression de la question: ' . $e->getMessage());
        }
    }
    
    public function show(Question $question)
    {
        return response()->json($question->load('options'));
    }
}