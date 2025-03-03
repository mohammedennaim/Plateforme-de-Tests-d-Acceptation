<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
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
            'content' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
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
            return redirect()->route('quiz.questions.index', $quiz->id)
                ->with('success', 'Question created successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to create question: ' . $e->getMessage());
        }
    }

    public function edit(Quiz $quiz, Question $question)
    {
        $options = $question->options;
        return view('quiz.questions.edit', compact('quiz', 'question', 'options'));
    }

    public function update(Request $request, Quiz $quiz, Question $question)
    {
        $request->validate([
            'content' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
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
            return redirect()->route('quiz.questions.index', $quiz->id)
                ->with('success', 'Question updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Failed to update question: ' . $e->getMessage());
        }
    }

    public function destroy(Quiz $quiz, Question $question)
    {
        try {
            $question->options()->delete();
            $question->delete();
            return redirect()->route('quiz.questions.index', $quiz->id)
                ->with('success', 'Question deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete question: ' . $e->getMessage());
        }
    }
}