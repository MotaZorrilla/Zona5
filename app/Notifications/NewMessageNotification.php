<?php

namespace App\Notifications;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    protected $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['database']; // Store notification in database
    }

    public function toArray($notifiable)
    {
        return [
            'message_id' => $this->message->id,
            'sender_name' => $this->message->sender_name,
            'subject' => $this->message->subject,
            'created_at' => $this->message->created_at,
            'type' => 'message',
        ];
    }
}