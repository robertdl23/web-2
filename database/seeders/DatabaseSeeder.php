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
        // Siempre: categorías base (no usa Faker)
        $this->call(CategorySeeder::class);

        // Usuario base fijo (no usa Faker)
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // SOLO en local/staging: poblar con factories (sí usan Faker)
        if (!app()->environment('production')) {
            if (User::count() < 21) {
                User::factory(20)->create();
            }

            $categories = Category::count() ? Category::all() : Category::factory(4)->create();

            $questions = Question::factory(30)->create([
                'category_id' => fn () => $categories->random()->id,
                'user_id'     => fn () => User::inRandomOrder()->first()->id,
            ]);

            Answer::factory(50)->create([
                'question_id' => fn () => $questions->random()->id,
                'user_id'     => fn () => User::inRandomOrder()->first()->id,
            ]);

            Comment::factory(100)->create([
                'commentable_id'   => fn () => $questions->random()->id,
                'commentable_type' => Question::class,
                'user_id'          => fn () => User::inRandomOrder()->first()->id,
            ]);
        }
    }
}
