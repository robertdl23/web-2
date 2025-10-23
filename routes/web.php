<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/
Route::get('/', [PageController::class, 'index'])->name('home');

/**
 * OVERRIDES de páginas de autenticación con TU layout.
 * OJO: deben ir ANTES de require auth.php
 */
Route::get('/login', fn () => view('auth.login'))->middleware('guest')->name('login');
Route::get('/register', fn () => view('auth.register'))->middleware('guest')->name('register');


/*
|--------------------------------------------------------------------------
| Rutas de autenticación de Livewire / framework
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Foro
|--------------------------------------------------------------------------
*/
// Detalle público
Route::get('/question/{question}', [QuestionController::class, 'show'])
    ->name('question.show');

// Comentarios (requiere login)
Route::post('/questions/{question}/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth');

// CRUD protegido
Route::middleware('auth')->group(function () {
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');

    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
});
