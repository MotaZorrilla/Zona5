@extends('layouts.admin')

@section('title', 'Editar Evento')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Editar Evento</h1>
            <p class="text-sm text-gray-500 mt-1">Modifica la información del evento.</p>
        </div>
        <a href="{{ route('admin.events.index') }}" class="flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded-lg shadow transition-transform transform hover:scale-105">
            <i class="ri-arrow-left-line mr-2"></i>
            <span>Volver</span>
        </a>
    </div>

    <!-- Event Form -->
    <form action="{{ route('admin.events.update', $event) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Title and Type -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título del Evento</label>
                <input type="text" name="title" id="title" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                       value="{{ old('title', $event->title) }}" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Evento</label>
                <select name="type" id="type" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                        required>
                    <option value="event" {{ old('type', $event->type) == 'event' ? 'selected' : '' }}>Evento General</option>
                    <option value="conference" {{ old('type', $event->type) == 'conference' ? 'selected' : '' }}>Conferencia</option>
                    <option value="meeting" {{ old('type', $event->type) == 'meeting' ? 'selected' : '' }}>Reunión</option>
                    <option value="workshop" {{ old('type', $event->type) == 'workshop' ? 'selected' : '' }}>Taller</option>
                    <option value="tenida" {{ old('type', $event->type) == 'tenida' ? 'selected' : '' }}>Tenida</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
            <textarea name="description" id="description" rows="4" 
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('description', $event->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <!-- Date and Time -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-1">Fecha y Hora de Inicio</label>
                <input type="datetime-local" name="start_time" id="start_time" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                       value="{{ old('start_time', $event->start_time->format('Y-m-d\TH:i')) }}" required>
                @error('start_time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-1">Fecha y Hora de Finalización</label>
                <input type="datetime-local" name="end_time" id="end_time" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                       value="{{ old('end_time', $event->end_time ? $event->end_time->format('Y-m-d\TH:i') : '') }}">
                @error('end_time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Location and Visibility -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Ubicación</label>
                <input type="text" name="location" id="location" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                       value="{{ old('location', $event->location) }}">
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center pt-6">
                <div class="flex items-center h-5">
                    <input id="is_public" name="is_public" type="checkbox" 
                           class="focus:ring-primary-500 h-4 w-4 text-primary-600 border-gray-300 rounded"
                           {{ old('is_public', $event->is_public) ? 'checked' : '' }}>
                </div>
                <div class="ml-3 text-sm">
                    <label for="is_public" class="font-medium text-gray-700">Evento Público</label>
                    <p class="text-gray-500">Visible para miembros y público general</p>
                </div>
            </div>
        </div>
        
        <!-- Submit Button -->
        <div class="flex justify-between pt-4">
            <a href="{{ route('admin.events.index') }}" 
               class="flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-6 rounded-lg shadow transition-transform transform hover:scale-105">
                <i class="ri-arrow-left-line mr-2"></i>
                <span>Cancelar</span>
            </a>
            
            <div class="flex space-x-3">
                <form action="{{ route('admin.events.destroy', $event) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="flex items-center bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-6 rounded-lg shadow transition-transform transform hover:scale-105"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este evento? Esta acción no se puede deshacer.')">
                        <i class="ri-delete-bin-line mr-2"></i>
                        <span>Eliminar</span>
                    </button>
                </form>
                
                <button type="submit" 
                        class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-6 rounded-lg shadow transition-transform transform hover:scale-105">
                    <i class="ri-save-line mr-2"></i>
                    <span>Actualizar Evento</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection