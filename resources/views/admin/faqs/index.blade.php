@extends('layouts.admin')

@section('title', 'Gestión de Preguntas Frecuentes')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-primary-600 mb-2">Preguntas Frecuentes</h1>
            <p class="text-sm text-gray-500">Gestiona las preguntas frecuentes del sitio público.</p>
        </div>
        <a href="{{ route('admin.faqs.create') }}" class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-add-line mr-2"></i>
            <span>Agregar Pregunta</span>
        </a>
    </div>

    <!-- FAQ List -->
    <div class="space-y-4">
        @forelse($faqs as $faq)
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-2">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $faq->question }}</h3>
                            @if($faq->category)
                                <span class="px-3 py-1 bg-primary-100 text-primary-800 rounded-full text-sm">
                                    {{ $faq->category }}
                                </span>
                            @endif
                            <span class="px-3 py-1 {{ $faq->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full text-sm">
                                {{ $faq->is_active ? 'Activa' : 'Inactiva' }}
                            </span>
                        </div>
                        <div class="text-gray-600 text-sm line-clamp-2">
                            {!! Str::limit(strip_tags($faq->answer), 150) !!}
                        </div>
                        <div class="mt-2 text-xs text-gray-500">
                            Orden: {{ $faq->order }} | Creada: {{ $faq->created_at->format('d M, Y') }}
                        </div>
                    </div>
                    <div class="flex items-center gap-2 ml-4">
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="p-2 rounded-full bg-primary-100 text-primary-700 hover:bg-primary-200 hover:scale-110 transition-all" title="Editar">
                            <i class="ri-pencil-line text-lg"></i>
                        </a>
                        <form action="{{ route('admin.faqs.toggle', $faq) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Cambiar estado de la pregunta?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="p-2 rounded-full {{ $faq->is_active ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} hover:scale-110 transition-all" title="{{ $faq->is_active ? 'Desactivar' : 'Activar' }}">
                                <i class="ri-{{ $faq->is_active ? 'pause' : 'play' }}-line text-lg"></i>
                            </button>
                        </form>
                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta pregunta?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 rounded-full bg-red-100 text-red-700 hover:bg-red-200 hover:scale-110 transition-all" title="Eliminar">
                                <i class="ri-delete-bin-line text-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <i class="ri-question-line text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900">No hay preguntas frecuentes</h3>
                <p class="mt-1 text-sm text-gray-500 mb-6">Aún no has creado ninguna pregunta frecuente.</p>
                <a href="{{ route('admin.faqs.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    <i class="ri-add-line mr-2"></i>
                    Crear Primera Pregunta
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($faqs->hasPages())
        <div class="mt-6">
            {{ $faqs->links() }}
        </div>
    @endif
</div>
@endsection