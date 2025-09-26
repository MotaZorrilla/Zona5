<div class="mr-4 relative" x-data="{ notificationsOpen: false }">
    <button @click="notificationsOpen = !notificationsOpen" class="relative p-1 text-gray-600 hover:text-gray-900">
        <i class="ri-notification-3-line text-xl"></i>
        @if($unreadCount > 0)
            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                {{ $unreadCount }}
            </span>
        @endif
    </button>
    <div x-show="notificationsOpen" @click.away="notificationsOpen = false" class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-xl py-1 z-20">
        <div class="px-4 py-2 border-b">
            <h3 class="text-sm font-semibold">Notificaciones</h3>
            <p class="text-xs text-gray-500">{{ $unreadCount }} nuevas</p>
        </div>
        <div class="max-h-80 overflow-y-auto">
            @forelse($unreadNotifications as $notification)
                <a href="{{ route('admin.messages.show', $notification->data['message_id']) }}" 
                   class="block px-4 py-3 border-b hover:bg-gray-50 notification-item"
                   wire:click="markAsRead({{ $notification->data['message_id'] }})"
                   x-data x-on:click="$wire.$dispatch('notificationRead')">
                    <p class="font-medium text-gray-800">{{ $notification->data['subject'] }}</p>
                    <p class="text-sm text-gray-600">De: {{ $notification->data['sender_name'] }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ \Carbon\Carbon::parse($notification->data['created_at'])->diffForHumans() }}</p>
                </a>
            @empty
                <div class="px-4 py-4 text-center">
                    <i class="ri-notification-line text-3xl text-gray-300 mb-2"></i>
                    <p class="text-sm text-gray-500">No tienes notificaciones nuevas</p>
                </div>
            @endforelse
        </div>
        <a href="{{ route('admin.messages.index') }}" class="block px-4 py-2 text-sm text-center text-primary-600 hover:bg-gray-50 border-t">
            Ver todas las notificaciones
        </a>
    </div>
</div>