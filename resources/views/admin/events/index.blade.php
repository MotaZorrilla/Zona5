@extends('layouts.admin')

@section('title', 'Gestión de Eventos')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-indigo-800 flex items-center gap-2">
                <i class="ri-calendar-todo-line"></i> Gestión de Eventos
            </h1>
            <p class="text-sm text-gray-600 mt-1">Planifica y administra los eventos de la Gran Zona.</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-add-line mr-2"></i>
            <span>Crear Nuevo Evento</span>
        </a>
    </div>

    <livewire:event-calendar />

    <!-- Events List -->
    <div>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
            <h3 class="text-xl font-bold text-gray-800">Lista de Eventos</h3>
            <div class="flex flex-wrap gap-3">
                <div class="relative">
                    <select name="status" onchange="window.location.href='?status='+this.value+'&type={{ request('type', '') }}'" class="appearance-none bg-gray-50 border border-gray-300 rounded-lg py-2 pl-4 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="" {{ request('status', '') == '' ? 'selected' : '' }}>Todos los eventos</option>
                        <option value="future" {{ request('status') == 'future' ? 'selected' : '' }}>Eventos futuros</option>
                        <option value="past" {{ request('status') == 'past' ? 'selected' : '' }}>Eventos pasados</option>
                    </select>
                    <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-3 text-gray-400 pointer-events-none"></i>
                </div>
                
                <div class="relative">
                    <select name="type" onchange="window.location.href='?type='+this.value+'&status={{ request('status', '') }}'" class="appearance-none bg-gray-50 border border-gray-300 rounded-lg py-2 pl-4 pr-8 text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                        <option value="">Todos los tipos</option>
                        <option value="event" {{ request('type') == 'event' ? 'selected' : '' }}>Evento</option>
                        <option value="conference" {{ request('type') == 'conference' ? 'selected' : '' }}>Conferencia</option>
                        <option value="meeting" {{ request('type') == 'meeting' ? 'selected' : '' }}>Reunión</option>
                        <option value="workshop" {{ request('type') == 'workshop' ? 'selected' : '' }}>Taller</option>
                        <option value="tenida" {{ request('type') == 'tenida' ? 'selected' : '' }}>Tenida</option>
                    </select>
                    <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-3 text-gray-400 pointer-events-none"></i>
                </div>
            </div>
        </div>
        
        <div class="space-y-4">
            @forelse ($events as $event)
            <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-{{ $event->is_public ? 'green' : 'pink' }}-100 rounded-lg flex flex-col items-center justify-center mr-4">
                        <span class="text-xs font-bold text-{{ $event->is_public ? 'green' : 'pink' }}-500">{{ \Carbon\Carbon::parse($event->start_time)->format('M') }}</span>
                        <span class="text-xl font-extrabold text-{{ $event->is_public ? 'green' : 'pink' }}-600">{{ \Carbon\Carbon::parse($event->start_time)->format('d') }}</span>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-800">{{ $event->title }}</p>
                        <p class="text-xs text-gray-500">
                            <i class="ri-map-pin-line mr-1"></i>{{ $event->location ?: 'Ubicación no especificada' }} | 
                            <i class="ri-time-line ml-2 mr-1"></i>{{ \Carbon\Carbon::parse($event->start_time)->format('H:i') }}
                            @if($event->end_time)
                                - {{ \Carbon\Carbon::parse($event->end_time)->format('H:i') }}
                            @endif
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.events.show', $event) }}" class="bg-blue-100 text-blue-600 px-3 py-1 rounded-md text-sm font-semibold hover:bg-blue-200">Ver</a>
                    <a href="{{ route('admin.events.edit', $event) }}" class="bg-gray-100 text-gray-600 px-3 py-1 rounded-md text-sm font-semibold hover:bg-gray-200">Editar</a>
                    <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-100 text-red-600 px-3 py-1 rounded-md text-sm font-semibold hover:bg-red-200" 
                                onclick="return confirm('¿Está seguro de eliminar este evento?')">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <i class="ri-calendar-2-line text-5xl text-gray-300 mb-4"></i>
                <h3 class="text-xl font-medium text-gray-500 mb-2">No hay eventos programados</h3>
                <p class="text-gray-400 mb-4">Comienza creando tu primer evento.</p>
                <a href="{{ route('admin.events.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                    <i class="ri-add-line mr-2"></i>
                    Crear Evento
                </a>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if ($events->hasPages())
        <div class="mt-6">
            {{ $events->links() }}
        </div>
        @endif
    </div>
</div>
@endsection