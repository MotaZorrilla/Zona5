<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ForumVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'forum_post_id',
        'vote_type',
    ];

    protected $casts = [
        'vote_type' => 'string',
    ];

    /**
     * Relación con el usuario que votó
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el post votado
     */
    public function forumPost(): BelongsTo
    {
        return $this->belongsTo(ForumPost::class);
    }

    /**
     * Scope para votos de tipo like
     */
    public function scopeLikes($query)
    {
        return $query->where('vote_type', 'like');
    }

    /**
     * Scope para votos de tipo dislike
     */
    public function scopeDislikes($query)
    {
        return $query->where('vote_type', 'dislike');
    }

    /**
     * Scope para votos de un usuario específico
     */
    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope para votos de un post específico
     */
    public function scopeForPost($query, $postId)
    {
        return $query->where('forum_post_id', $postId);
    }
}
