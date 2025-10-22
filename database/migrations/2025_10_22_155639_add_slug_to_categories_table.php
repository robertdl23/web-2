<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        // 1) Agregar columna (nullable para poder rellenarla)
        Schema::table('categories', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('id');
        });

        // 2) Rellenar slug para filas existentes
        $rows = DB::table('categories')->select('id', 'name')->get();
        foreach ($rows as $row) {
            DB::table('categories')
                ->where('id', $row->id)
                ->update(['slug' => Str::slug($row->name)]);
        }

        // 3) Crear índice único (SQLite lo soporta como índice)
        Schema::table('categories', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
