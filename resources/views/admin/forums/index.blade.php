@extends('layouts.admin')

@section('title', 'Gestión de Foros')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-indigo-800 flex items-center gap-2">
                <i class="ri-discuss-line"></i> Foros de Discusión
            </h1>
            <p class="text-sm text-gray-600 mt-1">Gestiona los foros y las discusiones de la comunidad.</p>
        </div>
        <a href="{{ route('admin.forums.create') }}" class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-add-line mr-2"></i>
            <span>Crear Foro</span>
        </a>
    </div>

    <!-- Forums List -->
    <div class="space-y-4">
        @forelse($forums as $forum)
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-2">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $forum->title }}</h3>
                            @if($forum->is_pinned)
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">
                                    <i class="ri-pushpin-line mr-1"></i>
                                    Pineado
                                </span>
                            @endif
                            @if($forum->category)
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                    {{ $forum->category }}
                                </span>
                            @endif
                            <span class="px-2 py-1 {{ $forum->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full text-xs">
                                {{ $forum->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                        <p class="text-gray-600 mb-3">{{ $forum->description }}</p>
                        <div class="flex items-center gap-6 text-sm text-gray-500">
                            <span>{{ $forum->posts_count }} publicaciones</span>
                            <span>Creado por: {{ $forum->creator->name ?? 'Desconocido' }}</span>
                            <span>{{ $forum->created_at->format('d M, Y') }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 ml-4">
                        <a href="{{ route('admin.forums.show', $forum) }}" class="p-2 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200 hover:scale-110 transition-all" title="Ver Posts">
                            <i class="ri-eye-line text-lg"></i>
                        </a>
                        <a href="{{ route('admin.forums.edit', $forum) }}" class="p-2 rounded-full bg-primary-100 text-primary-700 hover:bg-primary-200 hover:scale-110 transition-all" title="Editar">
                            <i class="ri-pencil-line text-lg"></i>
                        </a>
                        <form action="{{ route('admin.forums.toggle', $forum) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Cambiar estado del foro?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="p-2 rounded-full {{ $forum->is_active ? 'bg-yellow-100 text-yellow-700 hover:bg-yellow-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }} hover:scale-110 transition-all" title="{{ $forum->is_active ? 'Desactivar' : 'Activar' }}">
                                <i class="ri-{{ $forum->is_active ? 'pause' : 'play' }}-line text-lg"></i>
                            </button>
                        </form>
                        <form action="{{ route('admin.forums.destroy', $forum) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este foro?')">
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
                <i class="ri-discuss-line text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900">No hay foros</h3>
                <p class="mt-1 text-sm text-gray-500 mb-6">Aún no has creado ningún foro de discusión.</p>
                <a href="{{ route('admin.forums.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    <i class="ri-add-line mr-2"></i>
                    Crear Primer Foro
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection