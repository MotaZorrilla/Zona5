@extends('layouts.admin')

@section('title', 'Repositorio de Documentos')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-indigo-800 flex items-center gap-2">
                <i class="ri-archive-2-line"></i> Repositorio de Documentos
            </h1>
            <p class="text-sm text-gray-600 mt-1">Gestiona el material de estudio y administrativo.</p>
        </div>
        <a href="{{ route('admin.repository.create') }}" class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-upload-cloud-2-line mr-2"></i>
            <span>Subir Documento</span>
        </a>
    </div>

    <!-- Search and Filters -->
    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-6 rounded-xl mb-6 shadow-md">
        <form method="GET" action="{{ route('admin.repository.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <label class="block text-xs font-medium text-gray-700 mb-1">Buscar</label>
                <div class="relative">
                    <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Buscar en el repositorio..." class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" />
                </div>
            </div>
            
            <!-- Category Filter -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Categoría</label>
                <select name="category" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                    <option value="">Todas las categorías</option>
                    <option value="Ritual y Liturgia" {{ request('category') == 'Ritual y Liturgia' ? 'selected' : '' }}>Ritual y Liturgia</option>
                    <option value="Administración" {{ request('category') == 'Administración' ? 'selected' : '' }}>Administración</option>
                    <option value="Historia y Filosofía" {{ request('category') == 'Historia y Filosofía' ? 'selected' : '' }}>Historia y Filosofía</option>
                    <option value="Formación" {{ request('category') == 'Formación' ? 'selected' : '' }}>Formación</option>
                </select>
            </div>
            
            <!-- Grade Level Filter -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Grado</label>
                <select name="grade_level" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                    <option value="">Todos los grados</option>
                    <option value="Aprendiz" {{ request('grade_level') == 'Aprendiz' ? 'selected' : '' }}>Aprendiz</option>
                    <option value="Compañero" {{ request('grade_level') == 'Compañero' ? 'selected' : '' }}>Compañero</option>
                    <option value="Maestro" {{ request('grade_level') == 'Maestro' ? 'selected' : '' }}>Maestro</option>
                    <option value="Todos" {{ request('grade_level') == 'Todos' ? 'selected' : '' }}>Todos</option>
                </select>
            </div>
        </form>
        
        <div class="flex justify-end mt-4">
            <div class="flex space-x-2">
                <button type="submit" formmethod="GET" formaction="{{ route('admin.repository.index') }}" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
                    Filtrar
                </button>
                <a href="{{ route('admin.repository.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
                    Limpiar
                </a>
            </div>
        </div>
    </div>

    <!-- Category Folders -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6 mb-10">
        <a href="?category=Ritual y Liturgia" class="flex flex-col items-center justify-center p-4 bg-primary-50 rounded-lg text-center cursor-pointer hover:bg-primary-100 transition-colors">
            <i class="ri-folder-3-line text-5xl text-primary-400"></i>
            <span class="mt-2 text-sm font-semibold text-gray-700">Ritual y Liturgia</span>
        </a>
        <a href="?category=Administración" class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-lg text-center cursor-pointer hover:bg-green-100 transition-colors">
            <i class="ri-folder-3-line text-5xl text-green-400"></i>
            <span class="mt-2 text-sm font-semibold text-gray-700">Administración</span>
        </a>
        <a href="?category=Historia y Filosofía" class="flex flex-col items-center justify-center p-4 bg-yellow-50 rounded-lg text-center cursor-pointer hover:bg-yellow-100 transition-colors">
            <i class="ri-folder-3-line text-5xl text-yellow-400"></i>
            <span class="mt-2 text-sm font-semibold text-gray-700">Historia y Filosofía</span>
        </a>
        <a href="?category=Formación" class="flex flex-col items-center justify-center p-4 bg-pink-50 rounded-lg text-center cursor-pointer hover:bg-pink-100 transition-colors">
            <i class="ri-folder-3-line text-5xl text-pink-400"></i>
            <span class="mt-2 text-sm font-semibold text-gray-700">Formación</span>
        </a>
        <a href="{{ route('admin.repository.create') }}" class="flex flex-col items-center justify-center p-4 bg-gray-100 rounded-lg text-center cursor-pointer hover:bg-gray-200 transition-colors">
            <i class="ri-folder-add-line text-5xl text-gray-400"></i>
            <span class="mt-2 text-sm font-semibold text-gray-700">Nueva Categoría</span>
        </a>
    </div>

    <!-- Recent Documents List -->
    <div>
        <h3 class="text-xl font-bold text-gray-800 mb-4">Documentos Recientes</h3>
        <div class="space-y-4">
            @forelse ($repositories as $repository)
                <!-- Document Item -->
                <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between hover:shadow-md transition-shadow">
                    <div class="flex items-center">
                        @if($repository->file_type == 'pdf')
                            <i class="ri-file-pdf-2-line text-3xl text-red-500 mr-4"></i>
                        @elseif(in_array($repository->file_type, ['doc', 'docx']))
                            <i class="ri-file-word-2-line text-3xl text-blue-500 mr-4"></i>
                        @elseif(in_array($repository->file_type, ['xls', 'xlsx']))
                            <i class="ri-file-excel-2-line text-3xl text-green-500 mr-4"></i>
                        @elseif(in_array($repository->file_type, ['ppt', 'pptx']))
                            <i class="ri-file-ppt-2-line text-3xl text-orange-500 mr-4"></i>
                        @elseif(in_array($repository->file_type, ['jpg', 'jpeg', 'png']))
                            <i class="ri-image-2-line text-3xl text-purple-500 mr-4"></i>
                        @else
                            <i class="ri-file-3-line text-3xl text-gray-500 mr-4"></i>
                        @endif
                        <div>
                            <p class="font-semibold text-gray-800">{{ $repository->title }}</p>
                            <p class="text-xs text-gray-500">
                                Categoría: {{ $repository->category ?? 'Sin categoría' }} | 
                                Grado: {{ $repository->grade_level ?? 'Todos' }} | 
                                Subido por: {{ $repository->uploader ? $repository->uploader->name : 'Desconocido' }}
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm text-gray-500">{{ $repository->created_at->diffForHumans() }}</span>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('admin.repository.download', $repository) }}" class="p-2 rounded-full bg-green-100 text-green-700 hover:bg-green-200 hover:scale-110 transition-all" title="Descargar">
                                <i class="ri-download-line text-lg"></i>
                            </a>
                            <div class="relative" x-data="{ open: false }">
                                <button @click="open = !open" class="text-gray-500 hover:text-gray-700"><i class="ri-more-2-fill"></i></button>
                                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-10 py-1">
                                    <a href="{{ route('admin.repository.show', $repository) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ver Detalles</a>
                                    <a href="{{ route('admin.repository.edit', $repository) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Editar</a>
                                    <form method="POST" action="{{ route('admin.repository.destroy', $repository) }}" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este documento?');" class="block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <i class="ri-folder-3-line text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900">No se encontraron documentos</h3>
                    <p class="mt-1 text-sm text-gray-500">Aún no hay documentos en el repositorio.</p>
                    <div class="mt-6">
                        <a href="{{ route('admin.repository.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Subir Documento
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="mt-6">
            {{ $repositories->links() }}
        </div>
    </div>

</div>
@endsection