<?php

namespace App\Models;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name','email','password'];
    protected $hidden = ['password','remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)->explode(' ')->take(2)
            ->map(fn($w) => Str::substr($w, 0, 1))->implode('');
    }

    // ✅ preguntas del usuario
    public function questions()
    {
        return $this->hasMany(Question::class, 'user_id');
    }

    // (opcional) respuestas del usuario
    public function answers()
    {
        return $this->hasMany(Answer::class, 'user_id');
    }
}
