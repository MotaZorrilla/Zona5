<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'question',
        'answer',
        'category',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Scope para obtener solo las FAQ activas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para ordenar por el campo order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderBy('created_at');
    }

    /**
     * Obtener FAQs por categoría
     */
    public static function getByCategory($category)
    {
        return self::active()
                  ->where('category', $category)
                  ->ordered()
                  ->get();
    }

    /**
     * Obtener todas las categorías disponibles
     */
    public static function getCategories()
    {
        return self::select('category')
                  ->distinct()
                  ->whereNotNull('category')
                  ->pluck('category')
                  ->sort()
                  ->values();
    }
}