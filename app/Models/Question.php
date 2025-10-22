<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','title','content','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ✅ respuestas de la pregunta
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // ✅ comentarios sobre la pregunta (polimórfica)
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function create()
{
    // devuélvelas ordenadas; puedes usar pluck para select simple
    $categories = Category::orderBy('name')->get(['id','name']);

    return view('questions.create', [
        'categories' => $categories,
    ]);
}
