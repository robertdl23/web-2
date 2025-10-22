<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    // Permitimos asignación masiva de estos campos
    protected $fillable = ['name', 'slug'];

    // Genera el slug automáticamente al crear (si no se envía)
    protected static function booted(): void
    {
        static::creating(function (Category $category) {
            if (empty($category->slug) && !empty($category->name)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Relación con preguntas (ajusta si tu modelo se llama distinto)
    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    // Para route-model binding por slug (ej. /categories/php)
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
