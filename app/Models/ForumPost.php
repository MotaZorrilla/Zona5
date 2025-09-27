<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForumPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'forum_id',
        'title',
        'content',
        'author_id',
        'parent_id',
        'is_pinned',
        'is_locked',
        'is_approved',
        'likes_count',
        'dislikes_count',
        'views_count',
        'slug',
        'excerpt',
        'is_featured',
        'attachments',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'is_locked' => 'boolean',
        'is_approved' => 'boolean',
        'is_featured' => 'boolean',
        'likes_count' => 'integer',
        'dislikes_count' => 'integer',
        'views_count' => 'integer',
        'attachments' => 'array',
    ];

    /**
     * Relación con el foro
     */
    public function forum(): BelongsTo
    {
        return $this->belongsTo(Forum::class);
    }

    /**
     * Relación con el autor del post
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Relación con el post padre (para respuestas)
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(ForumPost::class, 'parent_id');
    }

    /**
     * Relación con las respuestas
     */
    public function replies()
    {
        return $this->hasMany(ForumPost::class, 'parent_id');
    }

    /**
     * Scope para posts aprobados
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope para posts pineados
     */
    public function scopePinned($query)
    {
        return $query->where('is_pinned', true);
    }

    /**
     * Scope para posts no bloqueados
     */
    public function scopeUnlocked($query)
    {
        return $query->where('is_locked', false);
    }

    /**
     * Scope para ordenar posts
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('is_pinned', 'desc')
                    ->orderBy('created_at', 'asc');
    }

    /**
     * Verificar si el post tiene respuestas
     */
    public function hasReplies()
    {
        return $this->replies()->exists();
    }

    /**
     * Contar respuestas del post
     */
    public function repliesCount()
    {
        return $this->replies()->count();
    }

    /**
     * Relación con los votos del post
     */
    public function votes()
    {
        return $this->hasMany(ForumVote::class);
    }

    /**
     * Relación con los likes del post
     */
    public function likes()
    {
        return $this->hasMany(ForumVote::class)->where('vote_type', 'like');
    }

    /**
     * Relación con los dislikes del post
     */
    public function dislikes()
    {
        return $this->hasMany(ForumVote::class)->where('vote_type', 'dislike');
    }

    /**
     * Scope para posts destacados
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope para ordenar por popularidad
     */
    public function scopeByPopularity($query)
    {
        return $query->orderByRaw('(likes_count - dislikes_count) desc');
    }

    /**
     * Scope para ordenar por votos
     */
    public function scopeByVotes($query)
    {
        return $query->orderByRaw('(likes_count + dislikes_count) desc');
    }

    /**
     * Verificar si un usuario ya votó
     */
    public function hasUserVoted($userId)
    {
        return $this->votes()->byUser($userId)->exists();
    }

    /**
     * Obtener el voto de un usuario específico
     */
    public function getUserVote($userId)
    {
        return $this->votes()->byUser($userId)->first();
    }

    /**
     * Verificar si un usuario dio like
     */
    public function hasUserLiked($userId)
    {
        return $this->votes()->byUser($userId)->likes()->exists();
    }

    /**
     * Verificar si un usuario dio dislike
     */
    public function hasUserDisliked($userId)
    {
        return $this->votes()->byUser($userId)->dislikes()->exists();
    }

    /**
     * Agregar like de un usuario
     */
    public function addLike($userId)
    {
        // Si ya existe un voto, actualizarlo
        $existingVote = $this->votes()->byUser($userId)->first();

        if ($existingVote) {
            if ($existingVote->vote_type === 'dislike') {
                $this->decrement('dislikes_count');
                $this->increment('likes_count');
                $existingVote->update(['vote_type' => 'like']);
            }
            return;
        }

        // Crear nuevo voto
        $this->votes()->create([
            'user_id' => $userId,
            'vote_type' => 'like'
        ]);

        $this->increment('likes_count');
    }

    /**
     * Agregar dislike de un usuario
     */
    public function addDislike($userId)
    {
        // Si ya existe un voto, actualizarlo
        $existingVote = $this->votes()->byUser($userId)->first();

        if ($existingVote) {
            if ($existingVote->vote_type === 'like') {
                $this->decrement('likes_count');
                $this->increment('dislikes_count');
                $existingVote->update(['vote_type' => 'dislike']);
            }
            return;
        }

        // Crear nuevo voto
        $this->votes()->create([
            'user_id' => $userId,
            'vote_type' => 'dislike'
        ]);

        $this->increment('dislikes_count');
    }

    /**
     * Remover voto de un usuario
     */
    public function removeVote($userId)
    {
        $vote = $this->votes()->byUser($userId)->first();

        if ($vote) {
            if ($vote->vote_type === 'like') {
                $this->decrement('likes_count');
            } else {
                $this->decrement('dislikes_count');
            }

            $vote->delete();
        }
    }

    /**
     * Incrementar contador de vistas
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Generar slug automáticamente
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($post) {
            if (empty($post->slug)) {
                $post->slug = \Illuminate\Support\Str::slug($post->title);
            }
        });
    }
}