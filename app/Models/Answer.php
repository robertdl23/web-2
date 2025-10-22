<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['question_id','user_id','content'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ comentarios sobre la respuesta (polimórfica)
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
