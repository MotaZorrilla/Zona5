@extends('layouts.admin')

@section('title', 'Gestión de Noticias')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Noticias</h1>
            <p class="text-sm text-gray-500 mt-1">Crea y administra las comunicaciones y artículos.</p>
        </div>
        <a href="{{ route('admin.news.create') }}" class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-quill-pen-line mr-2"></i>
            <span>Escribir Noticia</span>
        </a>
    </div>

    <!-- Tabs for filtering -->
    <div class="mb-6 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
            <li class="mr-2">
                <a href="#" class="inline-flex items-center justify-center p-4 border-b-2 border-primary-500 text-primary-600 rounded-t-lg active group" data-tab="published">
                    <i class="ri-check-double-line mr-2"></i>Publicadas ({{ $published->count() }})
                </a>
            </li>
            <li class="mr-2">
                <a href="#" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 group" data-tab="drafts">
                    <i class="ri-draft-line mr-2"></i>Borradores ({{ $drafts->count() }})
                </a>
            </li>
            <li class="mr-2">
                <a href="#" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 group" data-tab="scheduled">
                    <i class="ri-time-line mr-2"></i>Programadas ({{ $scheduled->count() }})
                </a>
            </li>
        </ul>
    </div>

    <!-- News Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Publicación</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($news as $article)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">{{ $article->title }}</div>
                        <div class="text-xs text-gray-500">{{ Str::limit($article->excerpt, 50) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $article->author->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($article->status === 'published')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Publicada</span>
                        @elseif($article->status === 'draft')
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Borrador</span>
                        @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Programada</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600">
                        {{ $article->published_at ? $article->published_at->format('d/m/Y') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.news.edit', $article) }}" class="text-primary-600 hover:text-primary-900 mr-4" title="Editar"><i class="ri-pencil-line text-lg"></i></a>
                        <a href="#" class="text-green-600 hover:text-green-900 mr-4" title="Previsualizar"><i class="ri-eye-line text-lg"></i></a>
                        <form action="{{ route('admin.news.destroy', $article) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar esta noticia?')">
                                <i class="ri-delete-bin-line text-lg"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                        No hay noticias disponibles.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-between items-center">
        <div class="text-sm text-gray-600">
            Mostrando <span class="font-bold">{{ $news->count() }}</span> resultados
        </div>
        <div class="flex items-center">
            <!-- Aquí iría la paginación real cuando se implemente -->
        </div>
    </div>
</div>

<script>
    // Script simple para manejar los tabs
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('[data-tab]');
        const rows = document.querySelectorAll('tbody tr');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remover clase activa de todos los tabs
                tabs.forEach(t => {
                    t.classList.remove('border-primary-500', 'text-primary-600', 'active');
                    t.classList.add('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
                });
                
                // Agregar clase activa al tab actual
                this.classList.remove('border-transparent', 'hover:text-gray-600', 'hover:border-gray-300');
                this.classList.add('border-primary-500', 'text-primary-600', 'active');
                
                // Filtrar filas según el tab seleccionado
                const tabType = this.getAttribute('data-tab');
                rows.forEach(row => {
                    if (tabType === 'published') {
                        row.style.display = row.querySelector('.bg-green-100') ? 'table-row' : 'none';
                    } else if (tabType === 'drafts') {
                        row.style.display = row.querySelector('.bg-yellow-100') ? 'table-row' : 'none';
                    } else if (tabType === 'scheduled') {
                        row.style.display = row.querySelector('.bg-blue-100') ? 'table-row' : 'none';
                    } else {
                        row.style.display = 'table-row';
                    }
                });
            });
        });
    });
</script>
@endsection
