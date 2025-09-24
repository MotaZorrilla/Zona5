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

    <!-- Filters Section -->
    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <form method="GET" action="{{ route('admin.news.index') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <label class="block text-xs font-medium text-gray-700 mb-1">Buscar</label>
                <div class="relative">
                    <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Buscar noticias..." class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" />
                </div>
            </div>
            
            <!-- Status Filter -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Estado</label>
                <select name="status" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                    <option value="">Todos</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Publicadas</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Borradores</option>
                    <option value="scheduled" {{ request('status') == 'scheduled' ? 'selected' : '' }}>Programadas</option>
                </select>
            </div>
            
            <!-- Date Range -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Desde</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" />
            </div>
            
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Hasta</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" />
            </div>
            
            <div class="flex items-end">
                <div class="w-full flex space-x-2">
                    <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.news.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
                        Limpiar
                    </a>
                </div>
            </div>
        </form>
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
    <div class="mt-6">
        {{ $news->links() }}
    </div>
</div>

<script>
    // Script simple para manejar los tabs
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('[data-tab]');
        
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
                
                // Actualizar el filtro de estado en la URL
                const tabType = this.getAttribute('data-tab');
                const currentUrl = new URL(window.location);
                if (tabType) {
                    currentUrl.searchParams.set('status', tabType);
                } else {
                    currentUrl.searchParams.delete('status');
                }
                
                // Cambiar parámetros de página si es necesario
                currentUrl.searchParams.delete('page');
                
                window.location.href = currentUrl.toString();
            });
        });
    });
</script>
@endsection
