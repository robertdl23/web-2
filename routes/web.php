<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CommentController;
use App\Models\Category;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/_migrate_seed/{token}', function (string $token) {
    abort_unless(hash_equals(env('SETUP_TOKEN', ''), $token), 403);

    // Si usas SQLite, crea el archivo si no existe
    if (config('database.default') === 'sqlite') {
        $path = database_path('database.sqlite');
        if (! file_exists($path)) {
            @mkdir(database_path(), 0775, true);
            touch($path);
        }
    }

    Artisan::call('migrate', ['--force' => true]);
    Artisan::call('db:seed', ['--force' => true]);

    return nl2br(e(Artisan::output()));
});

// Solo vuelve a sembrar categorías
Route::get('/_seed_categories/{token}', function (string $token) {
    abort_unless(hash_equals(env('SETUP_TOKEN', ''), $token), 403);

    Artisan::call('db:seed', [
        '--class' => 'Database\\Seeders\\CategorySeeder',
        '--force' => true,
    ]);

    return nl2br(e(Artisan::output()));
});

// Debug rápido: ver cuántas categorías hay
Route::get('/_debug_categories/{token}', function (string $token) {
    abort_unless(hash_equals(env('SETUP_TOKEN', ''), $token), 403);
    return [
        'connection' => config('database.default'),
        'db'         => config('database.connections.sqlite.database'),
        'count'      => \App\Models\Category::count(),
        'sample'     => \App\Models\Category::select('id','name','slug')->orderBy('id')->take(5)->get()
    ];
});