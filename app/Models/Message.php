<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_name',
        'sender_email',
        'subject',
        'content',
        'user_id',
        'recipient_id',
        'status',
        'read_at',
        'archived_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'archived_at' => 'datetime',
    ];

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function markAsRead()
    {
        if ($this->status === 'unread') {
            $this->update([
                'status' => 'read',
                'read_at' => now(),
            ]);
        }
    }

    public function markAsUnread()
    {
        $this->update([
            'status' => 'unread',
            'read_at' => null,
        ]);
    }

    public function archive()
    {
        $this->update([
            'status' => 'archived',
            'archived_at' => now(),
        ]);
    }

    public function scopeUnread($query)
    {
        return $query->where('status', 'unread');
    }

    public function scopeRead($query)
    {
        return $query->where('status', 'read');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    public function scopeInbox($query)
    {
        return $query->where('status', '!=', 'deleted')
                    ->whereNotNull('recipient_id');
    }

    public function isUnread()
    {
        return $this->status === 'unread';
    }

    public function isRead()
    {
        return $this->status === 'read';
    }

    public function isArchived()
    {
        return $this->status === 'archived';
    }

    public function isDeleted()
    {
        return $this->status === 'deleted';
    }
}
