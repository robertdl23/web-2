<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'content',
        'user_id',
    ];

    // --- Relaciones ---
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        // Si usas comentarios polimórficos
        return $this->morphMany(Comment::class, 'commentable')->latest();
    }

    public function answers(): HasMany
{
    return $this->hasMany(\App\Models\Answer::class);
}
}
