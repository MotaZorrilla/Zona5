@extends('layouts.admin')

@section('title', 'Bandeja de Entrada')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header mejorado -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-red-600 mb-2">Bandeja de Entrada</h1>
            <p class="text-sm text-gray-500">Gestiona tus mensajes y comunicaciones.</p>
        </div>
        <a href="{{ route('admin.messages.create') }}" class="flex items-center bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105">
            <i class="ri-add-line mr-2"></i>
            <span>Nuevo Mensaje</span>
        </a>
    </div>

    <!-- Navigation Tabs mejoradas -->
    <div class="mb-8 border-b-2 border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
            <li class="mr-2">
                <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center justify-center p-4 border-b-2 border-red-500 text-red-600 rounded-t-lg active group transition-all duration-200" data-tab="inbox">
                    <i class="ri-inbox-line mr-2 text-lg"></i>Entrada
                    @if($unreadCount ?? 0 > 0)
                        <span class="ml-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">{{ $unreadCount }}</span>
                    @endif
                </a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.messages.archived') }}" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 group transition-all duration-200" data-tab="archived">
                    <i class="ri-archive-line mr-2 text-lg"></i>Archivados
                </a>
            </li>
            <li class="mr-2">
                <a href="{{ route('admin.messages.deleted') }}" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 group transition-all duration-200" data-tab="deleted">
                    <i class="ri-delete-bin-line mr-2 text-lg"></i>Eliminados
                </a>
            </li>
        </ul>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-gradient-to-r from-green-100 to-emerald-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
            <div class="flex items-center">
                <i class="ri-check-circle-line text-xl mr-2"></i>
                <p class="font-bold">Éxito</p>
            </div>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 bg-gradient-to-r from-red-100 to-rose-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
            <div class="flex items-center">
                <i class="ri-error-warning-line text-xl mr-2"></i>
                <p class="font-bold">Error</p>
            </div>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <div class="flex h-[calc(100vh-400px)] bg-gray-50 rounded-lg overflow-hidden shadow-inner">
        <!-- Sidebar de Mensajes mejorado -->
        <div class="w-1/3 lg:w-1/4 border-r border-gray-200 bg-white overflow-y-auto">
            <!-- Filters Section mejorado -->
            <div class="p-6 border-b bg-gradient-to-r from-gray-50 to-blue-50">
                <form method="GET" action="{{ route('admin.messages.index') }}" id="message-filters" class="space-y-4">
                    <!-- Search mejorado -->
                    <div class="relative">
                        <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
                        <input type="search" name="search" value="{{ request('search') }}" placeholder="Buscar en mensajes..." class="w-full bg-white border-2 border-gray-200 rounded-lg py-3 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200 shadow-sm" />
                    </div>

                    <!-- Date Range mejorado -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-2">Desde</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 mb-2">Hasta</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200" />
                        </div>
                    </div>

                    <!-- Status Filter mejorado -->
                    <div>
                        <label class="block text-xs font-medium text-gray-700 mb-2">Estado</label>
                        <select name="status" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all duration-200">
                            <option value="">Todos</option>
                            <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>No leído</option>
                            <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Leído</option>
                        </select>
                    </div>

                    <!-- Apply Filters Button mejorado -->
                    <div class="flex space-x-2">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white text-sm font-bold py-2 px-4 rounded-lg shadow-md transition-all duration-200">
                            <i class="ri-filter-line mr-1"></i> Filtrar
                        </button>
                        <a href="{{ route('admin.messages.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-bold py-2 px-4 rounded-lg shadow-md transition-all duration-200">
                            <i class="ri-refresh-line mr-1"></i> Limpiar
                        </a>
                    </div>
                </form>
            </div>

            <!-- Lista de mensajes mejorada -->
            <nav class="flex-1" aria-label="Messages">
                @forelse ($messages as $message)
                    <a href="{{ route('admin.messages.show', $message) }}" class="block p-4 border-b border-gray-200 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-50 transition-all duration-200 @if($message->isUnread()) bg-gradient-to-r from-red-50 to-red-50 border-l-4 border-red-500 @endif">
                        <div class="flex justify-between items-start mb-2">
                            <div class="flex items-center flex-1">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-red-400 to-red-500 flex items-center justify-center mr-3 flex-shrink-0">
                                    <i class="ri-user-line text-white text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $message->sender_name }}</p>
                                    @if($message->sender_email)
                                        <p class="text-xs text-gray-500 truncate">{{ $message->sender_email }}</p>
                                    @endif
                                </div>
                            </div>
                            @if($message->isUnread())
                                <span class="h-3 w-3 rounded-full bg-red-500 flex-shrink-0"></span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-800 truncate mb-1">{{ $message->subject }}</p>
                        <div class="flex justify-between items-center">
                            <p class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
                            @if($message->recipient_id === null)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="ri-global-line mr-1"></i> Sitio Web
                                </span>
                            @endif
                        </div>
                    </a>
                @empty
                    <div class="p-8 text-center">
                        <i class="ri-mail-unread-line text-6xl text-gray-300 mb-4"></i>
                        <h3 class="mt-2 text-lg font-medium text-gray-900">No se encontraron mensajes</h3>
                        <p class="mt-1 text-sm text-gray-500 mb-6">Tu bandeja de entrada está vacía.</p>
                        <div class="flex justify-center space-x-3">
                            <a href="{{ route('admin.messages.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                <i class="ri-add-line mr-2"></i>
                                Crear Nuevo Mensaje
                            </a>
                            <a href="{{ route('public.contact') }}" target="_blank" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200">
                                <i class="ri-external-link-line mr-2"></i>
                                Ver Formulario Público
                            </a>
                        </div>
                    </div>
                @endforelse
            </nav>
        </div>

        <!-- Panel de Lectura mejorado -->
        @if($messages->count() > 0 && isset($message))
            <div class="w-2/3 lg:w-3/4 flex flex-col bg-white">
                <!-- Cabecera del Mensaje mejorada -->
                <div class="p-6 border-b bg-gradient-to-r from-gray-50 to-blue-50">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-red-400 to-red-500 flex items-center justify-center mr-4">
                                <i class="ri-user-star-line text-white text-lg"></i>
                            </div>
                            <div>
                                <h2 class="text-2xl font-bold text-gray-800">{{ $message->subject }}</h2>
                                <div class="flex items-center mt-1">
                                    <span class="text-sm font-semibold text-gray-900">{{ $message->sender_name }}</span>
                                    @if($message->sender_email)
                                        <span class="text-sm text-gray-500 mx-2">•</span>
                                        <span class="text-sm text-gray-600">{{ $message->sender_email }}</span>
                                    @endif
                                    @if($message->recipient_id === null)
                                        <span class="ml-2 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="ri-global-line mr-1"></i> Sitio Web
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500">{{ $message->created_at->format('d M Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $message->created_at->format('H:i') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Cuerpo del Mensaje mejorado -->
                <div class="p-6 overflow-y-auto flex-grow">
                    <div class="prose max-w-none">
                        <div class="bg-gray-50 p-4 rounded-lg border-l-4 border-red-500">
                            <div class="whitespace-pre-line text-gray-700 leading-relaxed">
                                {{ $message->content }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Acciones mejoradas -->
                <div class="p-6 border-t bg-gradient-to-r from-gray-50 to-blue-50">
                    <div class="flex items-center justify-end space-x-3">
                        <form action="{{ route('admin.messages.archive', $message) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="flex items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white text-sm font-bold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105" title="Archivar">
                                <i class="ri-archive-line mr-2"></i> Archivar
                            </button>
                        </form>

                        <form action="{{ route('admin.messages.unread', $message) }}" method="POST" class="inline-block">
                            @csrf
                            <button type="submit" class="flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white text-sm font-bold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105" title="Marcar como no leído">
                                <i class="ri-mail-unread-line mr-2"></i> Marcar No Leído
                            </button>
                        </form>

                        <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este mensaje?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white text-sm font-bold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105" title="Eliminar">
                                <i class="ri-delete-bin-line mr-2"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <!-- Panel vacío mejorado -->
            <div class="w-2/3 lg:w-3/4 flex items-center justify-center bg-gradient-to-br from-gray-50 to-blue-50">
                <div class="text-center">
                    <i class="ri-mail-line text-8xl text-gray-300 mb-6"></i>
                    <h3 class="text-2xl font-medium text-gray-900 mb-2">Selecciona un mensaje</h3>
                    <p class="text-gray-500 mb-8 text-lg">Elige un mensaje de la lista para leerlo aquí.</p>
                    <div class="flex justify-center space-x-4">
                        <a href="{{ route('admin.messages.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold rounded-lg shadow-lg transition-all duration-300 transform hover:scale-105">
                            <i class="ri-add-line mr-2"></i>
                            Nuevo Mensaje
                        </a>
                        <a href="{{ route('public.contact') }}" target="_blank" class="inline-flex items-center px-6 py-3 border-2 border-red-500 text-red-600 hover:bg-red-50 font-bold rounded-lg shadow-lg transition-all duration-300">
                            <i class="ri-external-link-line mr-2"></i>
                            Ver Formulario Público
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Pagination mejorada -->
    <div class="mt-8">
        {{ $messages->links() }}
    </div>
</div>
@endsection
