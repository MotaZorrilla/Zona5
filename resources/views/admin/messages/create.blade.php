@extends('layouts.admin')

@section('title', 'Nuevo Mensaje')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Nuevo Mensaje</h1>
            <p class="text-sm text-gray-500 mt-1">Escribe y envía un nuevo mensaje.</p>
        </div>
        <a href="{{ route('admin.messages.index') }}" class="flex items-center bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-arrow-left-line mr-2"></i>
            <span>Volver a la bandeja</span>
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
            <p class="font-bold">Errores de validación</p>
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg overflow-hidden">
        <form action="{{ route('admin.messages.store') }}" method="POST">
            @csrf
            
            <div class="p-6">
                <div class="grid grid-cols-1 gap-6">
                    <!-- Destinatario -->
                    <div>
                        <label for="recipient_id" class="block text-sm font-medium text-gray-700 mb-2">Destinatario</label>
                        <select id="recipient_id" name="recipient_id" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-masonic-gold focus:border-masonic-gold" required>
                            <option value="">Seleccionar destinatario</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('recipient_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Asunto -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Asunto</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-masonic-gold focus:border-masonic-gold" required>
                    </div>

                    <!-- Contenido -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Contenido</label>
                        <textarea id="content" name="content" rows="10" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-masonic-gold focus:border-masonic-gold" required>{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex items-center justify-end space-x-3">
                    <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-masonic-gold">
                        Cancelar
                    </a>
                    <button type="submit" class="flex items-center px-4 py-2 text-sm font-medium text-white bg-masonic-gold border border-transparent rounded-lg shadow-sm hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-masonic-gold transition-transform transform hover:scale-105">
                        <i class="ri-send-plane-line mr-2"></i> Enviar Mensaje
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection