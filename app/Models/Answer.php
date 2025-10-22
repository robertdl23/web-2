<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    use HasFactory;

    protected $fillable = ['question_id','user_id','content'];

   
public function question(): BelongsTo
{
    return $this->belongsTo(\App\Models\Question::class);
}

public function user(): BelongsTo
{
    return $this->belongsTo(\App\Models\User::class);
}

    // ✅ comentarios sobre la respuesta (polimórfica)
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
