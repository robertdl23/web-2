<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ---------- SETUP (usar 1 sola vez y luego borrar) ----------
Route::get('/_setup/{token}', function (string $token) {
    abort_unless(hash_equals(env('SETUP_TOKEN', ''), $token), 403);

    // Si usas SQLite, asegúrate de que exista el archivo
    if (config('database.default') === 'sqlite') {
        $path = database_path('database.sqlite');
        if (! file_exists($path)) {
            @mkdir(database_path(), 0775, true);
            touch($path);
        }
    }

    // Migraciones + seeders (forzado en producción)
    Artisan::call('migrate', ['--force' => true]);
    Artisan::call('db:seed', ['--force' => true]);

    // Opcional: cache de config/rutas/vistas
    Artisan::call('optimize');

    return response(nl2br(e(Artisan::output())), 200)
        ->header('Content-Type', 'text/html');
});
// ------------------------------------------------------------

Route::get('/', [PageController::class, 'index'])->name('home');

// Detalle público
Route::get('/question/{question}', [QuestionController::class, 'show'])
    ->name('question.show');

// Comentarios (requiere login)
Route::post('/questions/{question}/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth');

// Rutas protegidas (crear/editar/eliminar)
Route::middleware('auth')->group(function () {
    Route::get('/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions', [QuestionController::class, 'store'])->name('questions.store');

    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');

    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
});

require __DIR__ . '/auth.php';
