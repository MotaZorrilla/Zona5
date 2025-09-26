@extends('layouts.admin')

@section('title', $event->title)

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ $event->title }}</h1>
            <div class="flex items-center mt-2">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-{{ $event->is_public ? 'green' : 'pink' }}-100 text-{{ $event->is_public ? 'green' : 'pink' }}-800">
                    <i class="ri-eye-{{ $event->is_public ? 'line' : 'off-line' }} mr-1"></i>
                    {{ $event->is_public ? 'Público' : 'Privado' }}
                </span>
                <span class="ml-2 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    <i class="ri-calendar-event-line mr-1"></i>
                    {{ ucfirst($event->type) }}
                </span>
            </div>
        </div>
        <a href="{{ route('admin.events.index') }}" class="flex items-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded-lg shadow transition-transform transform hover:scale-105">
            <i class="ri-arrow-left-line mr-2"></i>
            <span>Volver</span>
        </a>
    </div>

    <!-- Event Details -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="prose max-w-none">
                @if($event->description)
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Descripción</h3>
                    <p class="text-gray-600">{{ $event->description }}</p>
                @else
                    <p class="text-gray-500 italic">No se ha proporcionado una descripción para este evento.</p>
                @endif
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Date Information -->
            <div class="bg-gray-50 p-5 rounded-lg">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Información del Evento</h3>
                
                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="ri-calendar-2-line text-gray-500 text-xl mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm text-gray-500">Fecha de inicio</p>
                            <p class="font-medium">{{ $event->start_time->format('d \\de F \\de Y') }}</p>
                            <p class="text-sm text-gray-600">{{ $event->start_time->format('g:i A') }}</p>
                        </div>
                    </div>
                    
                    @if($event->end_time)
                    <div class="flex items-start">
                        <i class="ri-calendar-2-line text-gray-500 text-xl mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm text-gray-500">Fecha de finalización</p>
                            <p class="font-medium">{{ $event->end_time->format('d \\de F \\de Y') }}</p>
                            <p class="text-sm text-gray-600">{{ $event->end_time->format('g:i A') }}</p>
                        </div>
                    </div>
                    @endif
                    
                    @if($event->location)
                    <div class="flex items-start">
                        <i class="ri-map-pin-line text-gray-500 text-xl mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm text-gray-500">Ubicación</p>
                            <p class="font-medium">{{ $event->location }}</p>
                        </div>
                    </div>
                    @endif
                    
                    <div class="flex items-start">
                        <i class="ri-user-line text-gray-500 text-xl mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm text-gray-500">Creado por</p>
                            <p class="font-medium">
                                @if($event->creator)
                                    {{ $event->creator->name }}
                                @else
                                    Sistema
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.events.edit', $event) }}" 
                   class="flex-1 flex items-center justify-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow transition-transform transform hover:scale-105">
                    <i class="ri-edit-line mr-2"></i>
                    <span>Editar</span>
                </a>
                
                <form action="{{ route('admin.events.destroy', $event) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="w-full flex items-center justify-center bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg shadow transition-transform transform hover:scale-105"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar este evento? Esta acción no se puede deshacer.')">
                        <i class="ri-delete-bin-line mr-2"></i>
                        <span>Eliminar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection