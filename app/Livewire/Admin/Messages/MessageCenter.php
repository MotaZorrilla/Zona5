<?php

namespace App\Livewire\Admin\Messages;

use Livewire\Component;
use App\Models\Message;
use Livewire\WithPagination;

class MessageCenter extends Component
{
    use WithPagination;

    public $selectedMessageId;
    public $filter = 'inbox'; // inbox, starred, sent, archived, deleted

    protected $queryString = ['filter'];

    protected $listeners = ['messageSelected'];

    public function messageSelected($messageId)
    {
        $this->selectedMessageId = $messageId;
        $message = Message::find($messageId);
        if ($message && $message->isUnread()) {
            $message->markAsRead();
        }
    }

    public function getSelectedMessageProperty()
    {
        return Message::find($this->selectedMessageId);
    }

    public function render()
    {
        $query = Message::query();

        switch ($this->filter) {
            case 'sent':
                // Assuming a `sender_id` column exists on the Message model
                $query->where('sender_id', auth()->id());
                break;
            case 'archived':
                $query->whereNotNull('archived_at');
                break;
            case 'deleted':
                $query->onlyTrashed();
                break;
            // Includes 'inbox' and 'starred' (for now, starred is just a filter on inbox)
            default:
                $query->where(function ($q) {
                    $q->where('recipient_id', auth()->id())
                      ->orWhereNull('recipient_id'); // General messages
                })->whereNull('archived_at');
                break;
        }
        
        if ($this->filter === 'starred') {
            $query->where('is_starred', true);
        }

        $messages = $query->latest()->paginate(15);
        
        $unreadMessagesCount = Message::where(function ($q) {
            $q->where('recipient_id', auth()->id())
              ->orWhereNull('recipient_id');
        })->where('status', 'unread')->count();

        return view('livewire.admin.messages.message-center', [
            'messages' => $messages,
            'unreadMessagesCount' => $unreadMessagesCount,
        ]);
    }
}
