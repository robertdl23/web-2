<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function show(Question $question)
    {
        $question->load('user', 'category', 'comments.user', 'answers.user', 'answers.comments.user');
        return view('questions.show', compact('question'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->pluck('name', 'id');
        return view('questions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title'       => ['required', 'string', 'max:255'],
            'content'     => ['required', 'string'],
        ]);

        $question = $request->user()->questions()->create($data);

        return redirect()
            ->route('question.show', $question)
            ->with('success', '¡Pregunta publicada correctamente!');
    }

    public function edit(Question $question)
    {
        $this->authorize('update', $question);

        $categories = Category::orderBy('name')->pluck('name', 'id');
        return view('questions.edit', compact('question', 'categories'));
    }

    public function update(Request $request, Question $question)
    {
        $this->authorize('update', $question);

        $data = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title'       => ['required', 'string', 'max:255'],
            'content'     => ['required', 'string'],
        ]);

        $question->update($data);

        return redirect()
            ->route('question.show', $question)
            ->with('success', '¡Pregunta actualizada!');
    }

    public function destroy(Question $question)
    {
        $this->authorize('delete', $question);

        $question->delete();

        return redirect()
            ->route('home')
            ->with('success', 'Pregunta eliminada.');
    }
}
