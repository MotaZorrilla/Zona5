<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Forum extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'description',
        'category',
        'is_active',
        'is_pinned',
        'order',
        'created_by',
        'posts_count',
        'last_activity_at',
        'color',
        'icon',
        'views_count',
        'is_featured',
        'excerpt',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_pinned' => 'boolean',
        'is_featured' => 'boolean',
        'order' => 'integer',
        'posts_count' => 'integer',
        'views_count' => 'integer',
        'last_activity_at' => 'datetime',
    ];

    /**
     * Relación con los posts del foro
     */
    public function posts(): HasMany
    {
        return $this->hasMany(ForumPost::class);
    }

    /**
     * Relación con el creador del foro
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope para foros activos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para foros pineados
     */
    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }

    /**
     * Scope para ordenar foros
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('is_pinned', 'desc')
                    ->orderBy('order')
                    ->orderBy('created_at', 'desc');
    }

    /**
     * Obtener foros por categoría
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

    /**
     * Obtener el último post del foro
     */
    public function latestPost()
    {
        return $this->hasOne(ForumPost::class)->latestOfMany();
    }

    /**
     * Contar posts del foro
     */
    public function postsCount()
    {
        return $this->posts()->count();
    }

    /**
     * Scope para foros destacados
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope para ordenar por actividad
     */
    public function scopeByActivity($query)
    {
        return $query->orderBy('last_activity_at', 'desc');
    }

    /**
     * Scope para ordenar por popularidad
     */
    public function scopeByPopularity($query)
    {
        return $query->orderBy('views_count', 'desc');
    }

    /**
     * Actualizar contador de posts
     */
    public function updatePostsCount()
    {
        $this->update(['posts_count' => $this->posts()->count()]);
    }

    /**
     * Actualizar última actividad
     */
    public function updateLastActivity()
    {
        $this->update(['last_activity_at' => now()]);
    }

    /**
     * Incrementar contador de vistas
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }
}