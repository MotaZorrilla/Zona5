<?php

namespace App\Models;

use App\Enums\MessageStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $sender_name
 * @property string $sender_email
 * @property string $subject
 * @property string $content
 * @property int $recipient_id
 * @property string $status
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property \Carbon\Carbon|null $archived_at
 */
class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sender_name',
        'sender_email',
        'subject',
        'content',
        'recipient_id',
        'status',
        'read_at',
        'archived_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'archived_at' => 'datetime',
    ];

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function scopeUnread($query)
    {
        return $query->where('status', MessageStatusEnum::UNREAD);
    }

    public function scopeRead($query)
    {
        return $query->where('status', MessageStatusEnum::READ);
    }

    public function scopeArchived($query)
    {
        return $query->whereNotNull('archived_at');
    }

    public function isUnread()
    {
        return $this->status === MessageStatusEnum::UNREAD;
    }

    public function markAsRead()
    {
        $this->update(['status' => 'read', 'read_at' => now()]);
    }

    public function markAsUnread()
    {
        $this->update(['status' => MessageStatusEnum::UNREAD, 'read_at' => null]);
    }

    public function archive()
    {
        $this->update(['archived_at' => now(), 'status' => 'archived']);
    }
}
