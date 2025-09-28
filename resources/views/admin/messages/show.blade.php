@extends('layouts.admin')

@section('title', 'Mensaje - ' . $message->subject)

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header mejorado -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-red-600 mb-2">Mensaje</h1>
            <p class="text-sm text-gray-500">Detalles del mensaje seleccionado.</p>
        </div>
        <div class="flex space-x-3">
            <a href="{{ route('admin.messages.index') }}" class="flex items-center bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                <i class="ri-arrow-left-line mr-2"></i>
                <span>Volver a la bandeja</span>
            </a>
            <a href="{{ route('admin.messages.create') }}" class="flex items-center bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition-all duration-300 transform hover:scale-105">
                <i class="ri-add-line mr-2"></i>
                <span>Nuevo Mensaje</span>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
        <!-- Cabecera del Mensaje mejorada -->
        <div class="p-6 border-b bg-gradient-to-r from-gray-50 to-blue-50">
            <div class="flex justify-between items-start">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-red-400 to-red-500 flex items-center justify-center mr-4">
                        <i class="ri-user-star-line text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $message->subject }}</h2>
                        <div class="flex items-center mt-2">
                            <div>
                                <div class="text-sm font-semibold text-gray-900">{{ $message->sender_name }}</div>
                                @if($message->sender_email)
                                    <div class="text-sm text-gray-600">{{ $message->sender_email }}</div>
                                @endif
                            </div>
                            @if($message->recipient_id === null)
                                <span class="ml-3 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="ri-global-line mr-1"></i> Sitio Web
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-sm font-medium text-gray-700">{{ $message->created_at->format('d M Y') }}</div>
                    <div class="text-xs text-gray-500">{{ $message->created_at->format('H:i') }}</div>
                </div>
            </div>
        </div>

        <!-- Cuerpo del Mensaje mejorado -->
        <div class="p-6">
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
            <div class="flex flex-wrap items-center justify-end gap-3">
                <form action="{{ route('admin.messages.archive', $message) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-600 hover:from-amber-600 hover:to-orange-700 text-white text-sm font-bold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                        <i class="ri-archive-line mr-2"></i> Archivar
                    </button>
                </form>

                <form action="{{ route('admin.messages.unread', $message) }}" method="POST" class="inline-block">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white text-sm font-bold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                        <i class="ri-mail-unread-line mr-2"></i> Marcar No Leído
                    </button>
                </form>

                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este mensaje?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white text-sm font-bold rounded-lg shadow-md transition-all duration-200 transform hover:scale-105">
                        <i class="ri-delete-bin-line mr-2"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection