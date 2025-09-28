<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notifications extends Component
{
    protected $listeners = [
        'notificationRead' => 'refreshNotificationCount',
        'notificationMarkedAsRead' => 'refreshNotificationCount',
    ];

    public function refreshNotificationCount()
    {
        $this->dispatch('$refresh');
    }

    public function markAsRead($messageId)
    {
        $message = \App\Models\Message::find($messageId);
        
        if ($message && $message->recipient_id === Auth::id()) {
            $message->markAsRead();
            
            // Emitir evento para actualizar otras partes de la interfaz
            $this->dispatch('notificationMarkedAsRead');
            
            // Actualizar inmediatamente el contador
            $this->dispatch('$refresh');
        }
    }

    public function getUnreadCountProperty()
    {
        if (!Auth::check()) {
            return 0;
        }

        // Contar mensajes no leídos (tanto del usuario como del sitio público)
        $userMessages = \App\Models\Message::where('recipient_id', Auth::id())
            ->where('status', 'unread')
            ->count();
        $publicMessages = \App\Models\Message::whereNull('recipient_id')
            ->where('status', 'unread')
            ->count();

        return $userMessages + $publicMessages;
    }

    public function render()
    {
        $unreadNotifications = Auth::check() ? Auth::user()->unreadNotifications : collect();
        
        return view('livewire.notifications', [
            'unreadNotifications' => $unreadNotifications,
            'unreadCount' => $this->unreadCount,
        ]);
    }
}