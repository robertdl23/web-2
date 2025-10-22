<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;

class QuestionPolicy
{
    /**
     * Determina si el usuario puede actualizar la pregunta.
     */
    public function update(User $user, Question $question): bool
    {
        return $user->id === $question->user_id;
    }

    /**
     * Determina si el usuario puede eliminar la pregunta.
     */
    public function delete(User $user, Question $question): bool
    {
        return $user->id === $question->user_id;
    }
}
