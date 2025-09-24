@extends('layouts.admin')

@section('title', 'Bandeja de Entrada')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Bandeja de Entrada</h1>
            <p class="text-sm text-gray-500 mt-1">Gestiona tus mensajes y comunicaciones.</p>
        </div>
        <a href="{{ route('admin.messages.create') }}" class="flex items-center bg-masonic-gold hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-add-line mr-2"></i>
            <span>Nuevo Mensaje</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
            <p class="font-bold">Éxito</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
            <p class="font-bold">Error</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="flex h-screen -mx-6 -mb-6">
        <!-- Sidebar de Mensajes -->
        <div class="w-1/3 lg:w-1/4 border-r border-gray-200 bg-gray-50 overflow-y-auto">
            <div class="p-4 border-b">
                <div class="relative">
                    <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
                    <input type="search" placeholder="Buscar en mensajes..." class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-masonic-gold focus:border-masonic-gold transition-colors" />
                </div>
            </div>
            <nav class="flex-1" aria-label="Messages">
                @forelse ($messages as $message)
                    <a href="{{ route('admin.messages.show', $message) }}" class="block p-4 border-b border-gray-200 hover:bg-gray-100 transition-all duration-200 @if($message->isUnread()) bg-masonic-blue bg-opacity-10 border-l-4 border-masonic-blue @endif">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ $message->sender_name }}</p>
                            @if($message->isUnread())
                                <span class="h-2 w-2 mt-1 rounded-full bg-masonic-gold"></span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-800 truncate mt-1">{{ $message->subject }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                    </a>
                @empty
                    <div class="p-8 text-center">
                        <i class="ri-mail-unread-line text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No hay mensajes</h3>
                        <p class="text-sm text-gray-500 mb-6">Tu bandeja de entrada está vacía.</p>
                        <a href="{{ route('admin.messages.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-masonic-gold hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-masonic-gold">
                            <i class="ri-add-line mr-2"></i>
                            Crear Nuevo Mensaje
                        </a>
                    </div>
                @endforelse
            </nav>
        </div>

        <!-- Panel de Lectura -->
        @if($messages->count() > 0 && isset($message))
            <div class="w-2/3 lg:w-3/4 flex flex-col">
                <!-- Cabecera del Mensaje -->
                <div class="p-6 border-b flex justify-between items-center bg-white">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $message->subject }}</h2>
                        <div class="flex items-center mt-2">
                            <div class="w-8 h-8 rounded-full bg-masonic-gold bg-opacity-20 flex items-center justify-center mr-3">
                                <i class="ri-user-line text-masonic-gold"></i>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ $message->sender_name }}</p>
                                <p class="text-xs text-gray-500">{{ $message->sender_email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $message->created_at->format('d M Y, H:i') }}
                    </div>
                </div>

                <!-- Cuerpo del Mensaje -->
                <div class="p-6 overflow-y-auto flex-grow bg-white">
                    <div class="prose max-w-none">
                        <div class="whitespace-pre-line text-gray-700 leading-relaxed">
                            {{ $message->content }}
                        </div>
                    </div>
                </div>

                <!-- Acciones -->
                <div class="p-4 border-t bg-gray-50">
                    <div class="flex items-center justify-end space-x-3">
                        <form action="{{ route('admin.messages.archive', $message) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-masonic-gold transition-all">
                                <i class="ri-archive-line mr-2"></i> Archivar
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este mensaje?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center px-4 py-2 text-sm font-medium text-red-700 bg-white border border-red-300 rounded-lg shadow-sm hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all">
                                <i class="ri-delete-bin-line mr-2"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <!-- Panel vacío -->
            <div class="w-2/3 lg:w-3/4 flex items-center justify-center bg-gray-50">
                <div class="text-center p-8">
                    <i class="ri-mail-line text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Selecciona un mensaje</h3>
                    <p class="text-gray-500 mb-6">Elige un mensaje de la lista para leerlo aquí.</p>
                    <a href="{{ route('admin.messages.create') }}" class="inline-flex items-center px-4 py-2 bg-masonic-gold hover:bg-yellow-600 text-white font-bold rounded-lg shadow-md transition-transform transform hover:scale-105">
                        <i class="ri-add-line mr-2"></i>
                        Nuevo Mensaje
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Paginación -->
@if($messages->hasPages())
    <div class="mt-6">
        {{ $messages->links() }}
    </div>
@endif
@endsection