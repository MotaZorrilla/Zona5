@extends('layouts.admin')

@section('title', 'Posts del Foro: ' . $forum->title)

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-primary-600 mb-2">{{ $forum->title }}</h1>
            <p class="text-sm text-gray-500">{{ $forum->description }}</p>
        </div>
        <a href="{{ route('admin.forums.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
            Volver a Foros
        </a>
    </div>

    <!-- Forum Info -->
    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">{{ $forum->category }}</span>
                <span class="px-3 py-1 {{ $forum->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full text-sm">
                    {{ $forum->is_active ? 'Activo' : 'Inactivo' }}
                </span>
                @if($forum->is_pinned)
                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                        <i class="ri-pushpin-line mr-1"></i>
                        Pineado
                    </span>
                @endif
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('admin.forums.edit', $forum) }}" class="px-3 py-1 bg-primary-100 text-primary-700 rounded text-sm hover:bg-primary-200">
                    Editar Foro
                </a>
            </div>
        </div>
    </div>

    <!-- Posts List -->
    <div class="space-y-4">
        @forelse($posts as $post)
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-4 mb-2">
                            <h4 class="text-lg font-semibold text-gray-900">{{ $post->title }}</h4>
                            @if($post->is_pinned)
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs">
                                    <i class="ri-pushpin-line mr-1"></i>
                                    Pineado
                                </span>
                            @endif
                            <span class="px-2 py-1 {{ $post->is_approved ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full text-xs">
                                {{ $post->is_approved ? 'Aprobado' : 'Pendiente' }}
                            </span>
                        </div>
                        <div class="text-gray-700 mb-3">{{ $post->content }}</div>
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span>Por: {{ $post->author->name ?? 'Desconocido' }}</span>
                            <span>{{ $post->created_at->format('d M, Y \a \l\a\s H:i') }}</span>
                            @if($post->hasReplies())
                                <span>{{ $post->repliesCount() }} respuestas</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-2 ml-4">
                        <button class="p-2 rounded-full bg-blue-100 text-blue-700 hover:bg-blue-200" title="Ver Respuestas">
                            <i class="ri-eye-line text-lg"></i>
                        </button>
                        <button class="p-2 rounded-full bg-primary-100 text-primary-700 hover:bg-primary-200" title="Editar">
                            <i class="ri-pencil-line text-lg"></i>
                        </button>
                        <button class="p-2 rounded-full bg-red-100 text-red-700 hover:bg-red-200" title="Eliminar">
                            <i class="ri-delete-bin-line text-lg"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <i class="ri-chat-1-line text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900">No hay publicaciones</h3>
                <p class="mt-1 text-sm text-gray-500">Este foro aún no tiene publicaciones.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($posts->hasPages())
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection