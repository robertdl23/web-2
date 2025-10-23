<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CommentController;

// Foro
Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('/question/{question}', [QuestionController::class, 'show'])->name('question.show');

Route::post('/questions/{question}/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');

    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
});

// Rutas de auth del starter (reset, verify, etc.)
require __DIR__.'/auth.php';

// --- OVERRIDES FINALES: muestran TUS blades bonitos en GET ---
Route::middleware('guest')->group(function () {
    Route::get('/login', fn () => view('auth.login'))->name('login');
    Route::get('/register', fn () => view('auth.register'))->name('register');
});
