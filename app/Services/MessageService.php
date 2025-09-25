<?php

namespace App\Services;

use App\Enums\MessageStatusEnum;
use App\Models\Message;
use App\Models\User;
use App\Repositories\MessageRepository;
use Illuminate\Support\Facades\Auth;

class MessageService extends BaseService
{
    protected $messageRepository;

    /**
     * Create a new service instance.
     */
    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * Get messages for the authenticated user
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMessagesForUser($relations = [])
    {
        return $this->messageRepository->getMessagesForUser($relations);
    }

    /**
     * Get archived messages for the authenticated user
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getArchivedMessages($relations = [])
    {
        return $this->messageRepository->getArchivedMessages($relations);
    }

    /**
     * Get deleted messages for the authenticated user
     *
     * @param array $relations
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDeletedMessages($relations = [])
    {
        return $this->messageRepository->getDeletedMessages($relations);
    }

    /**
     * Send a new message
     *
     * @param array $data
     * @return \App\Models\Message
     */
    public function sendMessage(array $data)
    {
        $messageData = [
            'sender_name' => Auth::user()->name,
            'sender_email' => Auth::user()->email,
            'subject' => $data['subject'],
            'content' => $data['content'],
            'recipient_id' => $data['recipient_id'],
            'status' => MessageStatusEnum::UNREAD,
        ];

        return $this->messageRepository->create($messageData);
    }

    /**
     * Archive a message
     *
     * @param int $messageId
     * @return bool
     */
    public function archiveMessage($messageId)
    {
        $message = $this->find($messageId);

        if ($message && $message->recipient_id === Auth::id()) {
            $message->archive();
            return true;
        }

        return false;
    }

    /**
     * Restore a message
     *
     * @param int $messageId
     * @return bool
     */
    public function restoreMessage($messageId)
    {
        $message = $this->messageRepository->find($messageId);
        $message = $message ? Message::withTrashed()->find($messageId) : null;

        if ($message && $message->recipient_id === Auth::id()) {
            $message->restore();
            $message->update(['status' => MessageStatusEnum::UNREAD]);
            return true;
        }

        return false;
    }

    /**
     * Mark a message as read
     *
     * @param int $messageId
     * @return bool
     */
    public function markAsRead($messageId)
    {
        $message = $this->find($messageId);

        if ($message && $message->recipient_id === Auth::id() && $message->isUnread()) {
            $message->markAsRead();
            return true;
        }

        return false;
    }

    /**
     * Mark a message as unread
     *
     * @param int $messageId
     * @return bool
     */
    public function markAsUnread($messageId)
    {
        $message = $this->find($messageId);

        if ($message && $message->recipient_id === Auth::id()) {
            $message->markAsUnread();
            return true;
        }

        return false;
    }
    
    /**
     * Find a message by ID
     *
     * @param int $id
     * @param array $relations
     * @return \App\Models\Message|null
     */
    public function find($id, $relations = [])
    {
        return $this->messageRepository->find($id, $relations);
    }
}