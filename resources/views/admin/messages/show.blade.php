@extends('layouts.admin')

@section('title', 'Mensaje - ' . $message->subject)

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Mensaje</h1>
            <p class="text-sm text-gray-500 mt-1">Detalles del mensaje seleccionado.</p>
        </div>
        <a href="{{ route('admin.messages.index') }}" class="flex items-center bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-arrow-left-line mr-2"></i>
            <span>Volver a la bandeja</span>
        </a>
    </div>

    <div class="bg-white rounded-lg overflow-hidden">
        <!-- Cabecera del Mensaje -->
        <div class="p-6 border-b bg-white">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $message->subject }}</h1>
                    <div class="mt-4 flex items-center">
                        <div class="w-12 h-12 rounded-full bg-masonic-gold bg-opacity-20 flex items-center justify-center mr-4">
                            <i class="ri-user-star-line text-masonic-gold text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-sm font-semibold text-gray-900">{{ $message->sender_name }}</div>
                            <div class="text-sm text-gray-600">{{ $message->sender_email }}</div>
                        </div>
                    </div>
                </div>
                <div class="text-sm text-gray-500 text-right">
                    <div class="font-medium">{{ $message->created_at->format('d M Y') }}</div>
                    <div>{{ $message->created_at->format('H:i') }}</div>
                </div>
            </div>
        </div>

        <!-- Cuerpo del Mensaje -->
        <div class="p-6">
            <div class="prose max-w-none">
                <div class="whitespace-pre-line text-gray-700 leading-relaxed">
                    {{ $message->content }}
                </div>
            </div>
        </div>

        <!-- Acciones -->
        <div class="p-6 border-t bg-gray-50">
            <div class="flex flex-wrap items-center justify-end gap-3">
                <form action="{{ route('admin.messages.archive', $message) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-masonic-gold transition-all">
                        <i class="ri-archive-line mr-2"></i> Archivar
                    </button>
                </form>
                
                <form action="{{ route('admin.messages.unread', $message) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-masonic-gold transition-all">
                        <i class="ri-mail-unread-line mr-2"></i> Marcar como no leído
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
</div>
@endsection