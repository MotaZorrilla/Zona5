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
        <a href="{{ route('admin.messages.create') }}" class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-add-line mr-2"></i>
            <span>Nuevo Mensaje</span>
        </a>
    </div>

    <!-- Navigation Tabs -->
    <div class="mb-6 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
            <li class="mr-2">
                <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center justify-center p-4 border-b-2 border-primary-500 text-primary-600 rounded-t-lg active group" data-tab="inbox">
                    <i class="ri-inbox-line mr-2"></i>Entrada
                </a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.messages.archived') }}" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 group" data-tab="archived">
                    <i class="ri-archive-line mr-2"></i>Archivados
                </a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.messages.deleted') }}" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 group" data-tab="deleted">
                    <i class="ri-delete-bin-line mr-2"></i>Eliminados
                </a>
            </li>
        </ul>
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
            <!-- Filters Section -->
            <div class="p-4 border-b bg-gray-50">
                <form method="GET" action="{{ route('admin.messages.index') }}" id="message-filters">
                    <div class="space-y-4">
                        <!-- Search -->
                        <div class="relative">
                            <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
                            <input type="search" name="search" value="{{ request('search') }}" placeholder="Buscar en mensajes..." class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" />
                        </div>
                        
                        <!-- Date Range -->
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Desde</label>
                                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">Hasta</label>
                                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" />
                            </div>
                        </div>
                        
                        <!-- Status Filter -->
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-1">Estado</label>
                            <select name="status" class="w-full bg-white border-2 border-gray-200 rounded-lg py-1 px-2 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                                <option value="">Todos</option>
                                <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>No leído</option>
                                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Leído</option>
                            </select>
                        </div>
                        
                        <!-- Apply Filters Button -->
                        <div class="flex space-x-2">
                            <button type="submit" class="flex-1 bg-primary-500 hover:bg-primary-600 text-white text-sm font-bold py-1.5 px-3 rounded-lg shadow-sm transition-colors">
                                Filtrar
                            </button>
                            <a href="{{ route('admin.messages.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-bold py-1.5 px-3 rounded-lg shadow-sm transition-colors">
                                Limpiar
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <nav class="flex-1" aria-label="Messages">
                @forelse ($messages as $message)
                    <a href="{{ route('admin.messages.show', $message) }}" class="block p-4 border-b border-gray-200 hover:bg-gray-100 transition-all duration-200 @if($message->isUnread()) bg-primary-100 border-l-4 border-primary-500 @endif">
                        <div class="flex justify-between items-start">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ $message->sender_name }}</p>
                            @if($message->isUnread())
                                <span class="h-2 w-2 mt-1 rounded-full bg-primary-500"></span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-800 truncate mt-1">{{ $message->subject }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                    </a>
                @empty
                    <div class="p-8 text-center">
                        <i class="ri-mail-unread-line text-6xl text-gray-300 mb-4"></i>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No se encontraron mensajes</h3>
                        <p class="mt-1 text-sm text-gray-500">Tu bandeja de entrada está vacía.</p>
                        <div class="mt-6">
                            <a href="{{ route('admin.messages.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                <i class="ri-add-line mr-2"></i>
                                Crear Nuevo Mensaje
                            </a>
                        </div>
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
                            <div class="w-10 h-10 flex-shrink-0 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                <i class="ri-user-star-line text-primary-500"></i>
                            </div>
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $message->sender_name }}</div>
                                <div class="text-xs text-gray-500">{{ $message->sender_email }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 text-right">
                        {{ $message->created_at->format('d M Y, H:i') }}
                    </div>
                </div>

                <!-- Cuerpo del Mensaje -->
                <div class="p-6 overflow-y-auto flex-grow">
                    <div class="prose max-w-none">
                        <div class="whitespace-pre-line text-gray-700 leading-relaxed">
                            {{ $message->content }}
                        </div>
                    </div>
                </div>

                <!-- Acciones -->
                <div class="p-4 border-t bg-gray-50">
                    <div class="flex items-center justify-end space-x-2">
                        <form action="{{ route('admin.messages.archive', $message) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="p-2 rounded-full bg-primary-100 text-primary-700 hover:bg-primary-200 hover:scale-110 transition-all" title="Archivar">
                                <i class="ri-archive-line text-lg"></i>
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.messages.unread', $message) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="p-2 rounded-full bg-primary-100 text-primary-700 hover:bg-primary-200 hover:scale-110 transition-all" title="Marcar como no leído">
                                <i class="ri-mail-unread-line text-lg"></i>
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este mensaje?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-full bg-red-100 text-red-700 hover:bg-red-200 hover:scale-110 transition-all" title="Eliminar">
                                <i class="ri-delete-bin-line text-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <!-- Panel vacío -->
            <div class="w-2/3 lg:w-3/4 flex items-center justify-center bg-gray-50">
                <div class="text-center">
                    <i class="ri-mail-line text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-medium text-gray-900 mb-2">Selecciona un mensaje</h3>
                    <p class="text-gray-500 mb-6">Elige un mensaje de la lista para leerlo aquí.</p>
                    <a href="{{ route('admin.messages.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-500 hover:bg-primary-600 text-white font-bold rounded-lg shadow-md transition-transform transform hover:scale-105">
                        <i class="ri-add-line mr-2"></i>
                        Nuevo Mensaje
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $messages->links() }}
    </div>
</div>
@endsection