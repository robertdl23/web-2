<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Comment;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
{
    // Asegurar que no existan duplicados antes de crear
    $user = \App\Models\User::updateOrCreate(
        ['email' => 'test@example.com'],
        [
            'name' => 'Test User',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]
    );

    // Crear usuarios adicionales si no existen suficientes
    if (User::count() < 21) {
        User::factory(20)->create();
    }

    $categories = Category::factory(4)->create();

    $questions = Question::factory(30)->create([
        'category_id' => fn() => $categories->random()->id,
        'user_id' => fn() => User::inRandomOrder()->first()->id,
    ]);

    Answer::factory(50)->create([
        'question_id' => fn() => $questions->random()->id,
        'user_id' => fn() => User::inRandomOrder()->first()->id,
    ]);

    Comment::factory(100)->create([
        'commentable_id' => fn() => $questions->random()->id,
        'commentable_type' => Question::class,
        'user_id' => fn() => User::inRandomOrder()->first()->id,
    ]);
}
}
  
    

