<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index(Quiz $quiz)
    {
        $questions = $quiz->questions()->with('options')->get();
        return view('questions.index', compact('quiz', 'questions'));
    }

    public function create(Quiz $quiz)
    {
        return view('questions.create', compact('quiz'));
    }

    public function store(Request $request, Quiz $quiz)
    {
        $request->validate([
            'content' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*' => 'required|string',
            'correct_option' => 'required|numeric|min:0|max:' . (count($request->options) - 1),
        ]);

        DB::beginTransaction();

        try {
            $question = $quiz->questions()->create([
                'content' => $request->content,
            ]);

            foreach ($request->options as $index => $optionContent) {
                $question->options()->create([
                    'content' => $optionContent,
                    'is_correct' => ($index == $request->correct_option),
                ]);
            }

            DB::commit();

            return redirect()->route('quizzes.questions.index', $quiz->id)
                ->with('success', 'Question ajoutée avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    public function edit(Question $question)
    {
        $question->load('options');
        return view('questions.edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $request->validate([
            'content' => 'required|string',
            'options' => 'required|array|min:2',
            'options.*.content' => 'required|string',
            'correct_option' => 'required|numeric|min:0|max:' . (count($request->options) - 1),
        ]);

        DB::beginTransaction();

        try {
            $question->update([
                'content' => $request->content,
            ]);

            foreach ($request->options as $index => $optionData) {
                Option::where('id', $optionData['id'])->update([
                    'content' => $optionData['content'],
                    'is_correct' => ($index == $request->correct_option),
                ]);
            }

            DB::commit();

            return redirect()->route('quizzes.questions.index', $question->quiz_id)
                ->with('success', 'Question mise à jour avec succès');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Une erreur est survenue: ' . $e->getMessage());
        }
    }

    public function destroy(Question $question)
    {
        $quizId = $question->quiz_id;
        $question->delete();

        return redirect()->route('quizzes.questions.index', $quizId)
            ->with('success', 'Question supprimée avec succès');
    }
}