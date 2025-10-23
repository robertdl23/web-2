<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    public function create()
    {
        // Solo id y name para el select
        $categories = Category::orderBy('name')->get(['id','name']);

        return view('questions.create', [
            'categories' => $categories,
            'question'   => new Question(), // para reutilizar el partial _form
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'title'       => ['required', 'string', 'min:5', 'max:150'],
            'content'     => ['required', 'string', 'min:20'],
        ]);

        $question = Question::create([
            'category_id' => $validated['category_id'],
            'title'       => $validated['title'],
            'content'     => $validated['content'],
            'user_id'     => $request->user()->id, // requiere auth
        ]);

        return redirect()
            ->route('question.show', $question)
            ->with('status', 'Pregunta creada correctamente.');
    }

    public function edit(Question $question)
    {
        // Igual que en create: solo id y name
        $categories = Category::orderBy('name')->get(['id','name']);

        return view('questions.edit', [
            'categories' => $categories,
            'question'   => $question,
        ]);
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'title'       => ['required', 'string', 'min:5', 'max:150'],
            'content'     => ['required', 'string', 'min:20'],
        ]);

        $question->update($validated);

        return redirect()
            ->route('question.show', $question)
            ->with('status', 'Pregunta actualizada correctamente.');
    }

   public function show(\App\Models\Question $question)
{
    // carga respuestas con su autor y también la categoría y autor de la pregunta
    $question->load(['answers.user', 'category', 'user']);

    return view('questions.show', compact('question'));
}


    public function destroy(\App\Models\Question $question)
{
    // (Opcional) reglas de autorización:
    $this->authorize('delete', $question);

    $question->delete();

    // Redirige a la portada del foro
    return redirect()
        ->route('home')            // o ->route('questions.index') si tienes listado
        ->with('status', 'Pregunta eliminada correctamente.');
}
}
