<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $validatedData = $request->validate([
            'text' => 'required|string',
            'is_correct' => 'sometimes|boolean',
        ]);

        $question->options()->create($validatedData);

        return back()->with('success', 'Option created successfully.');
    }

    public function update(Request $request, Option $option)
    {
        $validatedData = $request->validate([
            'text' => 'required|string',
            'is_correct' => 'sometimes|boolean',
        ]);

        $option->update($validatedData);

        return back()->with('success', 'Option updated successfully.');
    }

    public function destroy(Option $option)
    {
        $option->delete();

        return back()->with('success', 'Option deleted successfully.');
    }
}
