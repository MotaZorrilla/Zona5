@extends('layouts.admin')

@section('title', 'Mensajes Destacados')

@section('content')
<div class="flex h-[calc(100vh-150px)] bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-xl overflow-hidden border-gray-10">

    <!-- Sidebar de Navegación -->
    <aside class="w-72 bg-gradient-to-b from-indigo-700 to-purple-800 text-white p-5 flex-shrink-0 shadow-lg">
        <div class="mb-8">
            <h2 class="text-2xl font-bold flex items-center gap-2">
                <i class="ri-mail-line text-xl"></i> Mensajes
            </h2>
        </div>
        
        <div class="mb-6">
            <a href="{{ route('admin.messages.create') }}" class="w-full flex items-center justify-center bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white font-bold py-4 px-5 rounded-xl shadow-lg transition-all transform hover:scale-105 duration-300 flex items-center gap-2">
                <i class="ri-add-line text-lg"></i>
                <span>Nuevo Mensaje</span>
            </a>
        </div>
        
        <nav class="space-y-1 mt-6">
            <a href="{{ route('admin.messages.index') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-600 rounded-xl transition-all duration-300 hover:text-white group">
                <i class="ri-inbox-line mr-3 text-xl group-hover:text-blue-300 transition-colors"></i>
                <span>Entrada</span>
                <span class="ml-auto bg-gray-200 text-gray-600 text-sm font-bold rounded-full h-7 w-7 flex items-center justify-center">{{ $unreadMessagesCount }}</span>
            </a>
            <a href="{{ route('admin.messages.starred') }}" class="flex items-center px-4 py-3 text-white font-semibold bg-indigo-600 rounded-xl mb-1 transition-all duration-300 hover:bg-indigo-500 shadow-md">
                <i class="ri-star-line mr-3 text-xl"></i>
                <span>Destacados</span>
            </a>
            <a href="{{ route('admin.messages.sent') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-600 rounded-xl transition-all duration-300 hover:text-white group">
                <i class="ri-send-plane-line mr-3 text-xl group-hover:text-green-300 transition-colors"></i>
                <span>Enviados</span>
            </a>
            <a href="{{ route('admin.messages.archived') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-600 rounded-xl transition-all duration-300 hover:text-white group">
                <i class="ri-archive-line mr-3 text-xl group-hover:text-purple-300 transition-colors"></i>
                <span>Archivados</span>
            </a>
            <a href="{{ route('admin.messages.deleted') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-600 rounded-xl transition-all duration-300 hover:text-white group">
                <i class="ri-delete-bin-line mr-3 text-xl group-hover:text-red-300 transition-colors"></i>
                <span>Eliminados</span>
            </a>
        </nav>
    </aside>

    <!-- Lista de Mensajes -->
    <div class="w-2/5 border-r border-gray-200 flex flex-col bg-white shadow-inner">
        <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-white to-indigo-50 sticky top-0 bg-white z-10 shadow-sm">
            <h1 class="text-2xl font-bold text-indigo-800 flex items-center gap-2">
                <i class="ri-star-line"></i> Destacados
            </h1>
            <div class="relative mt-4">
                <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400 text-lg"></i>
                <input type="search" name="search" placeholder="Buscar en destacados..." class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-400 transition-all shadow-sm focus:shadow-md" />
            </div>
        <div class="overflow-y-auto flex-grow">
            @forelse ($messages as $message)
                <a href="{{ route('admin.messages.show', $message) }}" class="block p-4 border-b border-gray-100 hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-300 @if($message->isUnread()) bg-gradient-to-r from-indigo-50 to-blue-50 border-l-4 border-indigo-500 @else border-l-4 border-transparent @endif group relative overflow-hidden">
                    <div class="flex justify-between items-start mb-2">
                        <p class="text-base font-bold text-gray-800 truncate">{{ $message->sender_name }}</p>
                        @if($message->isUnread())
                            <span class="h-3 w-3 mt-1 rounded-full bg-indigo-50 animate-pulse"></span>
                        @endif
                    </div>
                    <p class="text-sm font-semibold text-indigo-700 truncate mb-1">{{ $message->subject }}</p>
                    <p class="text-xs text-gray-600 mt-1 line-clamp-2">{{ Str::limit(strip_tags($message->content), 100) }}</p>
                    <div class="flex justify-between items-center mt-3 text-xs text-gray-500">
                        <span>{{ $message->created_at->diffForHumans() }}</span>
                        <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity absolute right-4 top-1/2 -translate-y-1/2 bg-white rounded-full p-1 shadow-md">
                            <button title="Archivar" class="p-2 rounded-full hover:bg-indigo-100 text-gray-500 hover:text-indigo-600"><i class="ri-archive-line"></i></button>
                            <button title="Eliminar" class="p-2 rounded-full hover:bg-red-100 text-gray-500 hover:text-red-600"><i class="ri-delete-bin-line"></i></button>
                            <button title="Marcar como no leído" class="p-2 rounded-full hover:bg-blue-100 text-gray-500 hover:text-blue-600"><i class="ri-mail-unread-line"></i></button>
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-10 text-center h-full flex flex-col justify-center items-center">
                    <div class="w-24 h-24 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                        <i class="ri-star-line text-4xl text-indigo-400"></i>
                    </div>
                    <h3 class="mt-2 text-xl font-bold text-gray-70">No hay mensajes destacados</h3>
                    <p class="mt-1 text-gray-500">Marca mensajes como destacados para verlos aquí.</p>
                </div>
            @endforelse
        </div>
        <div class="p-4 border-t border-gray-100 bg-gray-50">
            {{ $messages->links() }}
        </div>
    </div>

    <!-- Panel de Lectura -->
    <div class="w-3/5 flex flex-col bg-gradient-to-b from-gray-50 to-indigo-50 shadow-inner">
        @if(isset($selectedMessage))
            <div class="p-6 border-b border-gray-200 bg-white shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-80">{{ $selectedMessage->subject }}</h2>
                        <div class="flex items-center mt-3">
                            <div class="w-12 h-12 flex-shrink-0 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mr-4 shadow-md">
                                <i class="ri-user-star-line text-indigo-500 text-xl"></i>
                            </div>
                            <div>
                                <div class="text-base font-semibold text-gray-800">{{ $selectedMessage->sender_name }}</div>
                                <div class="text-sm text-gray-500">{{ $selectedMessage->sender_email }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 text-right">
                        {{ $selectedMessage->created_at->format('d M Y, H:i A') }}
                    </div>
                </div>
            </div>
            <div class="p-8 overflow-y-auto flex-grow bg-white bg-opacity-50">
                <div class="prose max-w-none bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <div class="whitespace-pre-line text-gray-70 leading-relaxed text-base">
                        {!! $selectedMessage->content !!}
                    </div>
                </div>
            </div>
            <div class="p-5 border-t border-gray-200 bg-white shadow-sm">
                <div class="flex items-center justify-end space-x-4">
                    <button class="flex items-center px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white font-semibold transition-all shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                        <i class="ri-reply-line mr-2"></i> Responder
                    </button>
                    <form action="{{ route('admin.messages.archive', $selectedMessage) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="p-3 rounded-full bg-gray-100 hover:bg-indigo-100 text-gray-600 hover:text-indigo-600 shadow-sm hover:shadow-md transition-all" title="Archivar"><i class="ri-archive-line text-lg"></i></button>
                    </form>
                    <form action="{{ route('admin.messages.unread', $selectedMessage) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="p-3 rounded-full bg-gray-100 hover:bg-blue-100 text-gray-600 hover:text-blue-600 shadow-sm hover:shadow-md transition-all" title="Marcar como no leído"><i class="ri-mail-unread-line text-lg"></i></button>
                    </form>
                    <form action="{{ route('admin.messages.destroy', $selectedMessage) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este mensaje?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-3 rounded-full bg-gray-100 hover:bg-red-100 text-gray-600 hover:text-red-600 shadow-sm hover:shadow-md transition-all" title="Eliminar"><i class="ri-delete-bin-line text-lg"></i></button>
                    </form>
                </div>
            </div>
        @else
            <div class="flex items-center justify-center h-full bg-gradient-to-br from-indigo-50 to-purple-50 p-8">
                <div class="text-center max-w-md">
                    <div class="w-32 h-32 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="ri-star-line text-5xl text-indigo-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-80 mb-3">Selecciona un mensaje</h3>
                    <p class="text-gray-60">Elige un mensaje de la lista para leerlo aquí.</p>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection