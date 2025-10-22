<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Cargar categorías primero
        $this->call(CategorySeeder::class);

        // 2) Usuario base
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // 3) Asegurar mínimo 21 usuarios
        $faltan = 21 - User::count();
        if ($faltan > 0) {
            User::factory($faltan)->create();
        }

        // 4) Datos relacionados
        $categories = Category::all();

        $questions = Question::factory(30)->create([
            'category_id' => fn () => $categories->random()->id,
            'user_id'     => fn () => User::inRandomOrder()->value('id'),
        ]);

        Answer::factory(50)->create([
            'question_id' => fn () => $questions->random()->id,
            'user_id'     => fn () => User::inRandomOrder()->value('id'),
        ]);

        Comment::factory(100)->create([
            'commentable_id'   => fn () => $questions->random()->id,
            'commentable_type' => Question::class,
            'user_id'          => fn () => User::inRandomOrder()->value('id'),
        ]);
    }
}
