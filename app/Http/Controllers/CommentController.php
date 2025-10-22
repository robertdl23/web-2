<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Question;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $request->validate([
            'content' => ['required', 'string', 'max:500'],
        ]);

        $question->comments()->create([
            'content' => $request->content,
            'user_id' => $request->user()->id,
        ]);

        return back()->with('success', 'Comentario agregado con éxito.');
    }
}
