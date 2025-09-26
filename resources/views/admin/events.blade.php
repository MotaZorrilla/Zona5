@extends('layouts.admin')

@section('title', 'Gestión de Eventos')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-primary-600 mb-2">Gestión de Eventos</h1>
            <p class="text-sm text-gray-500">Planifica y administra los eventos de la Gran Zona.</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="flex items-center bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
            <i class="ri-calendar-2-line mr-2"></i>
            <span>Crear Nuevo Evento</span>
        </a>
    </div>

    <div class="text-center py-12">
        <i class="ri-calendar-2-line text-5xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-medium text-gray-500 mb-2">Redirigiendo a la nueva interfaz de eventos...</h3>
        <p class="text-gray-400 mb-4">Por favor espere mientras lo redirigimos a la nueva página de gestión de eventos.</p>
    </div>
    
    <script>
        setTimeout(function() {
            window.location.href = "{{ route('admin.events.index') }}";
        }, 1000);
    </script>
</div>
@endsection