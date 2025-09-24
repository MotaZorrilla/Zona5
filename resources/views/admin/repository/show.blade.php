@extends('layouts.admin')

@section('title', $repository->title . ' - Repositorio')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $repository->title }}</h1>
                <p class="text-sm text-gray-500 mt-1">Detalles del documento en el repositorio.</p>
            </div>
            <a href="{{ route('admin.repository.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Volver
            </a>
        </div>
    </div>

    <!-- Document Info -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Tipo de Archivo</h3>
            <p class="text-lg font-semibold text-gray-800">{{ strtoupper($repository->file_type) }}</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Tamaño</h3>
            <p class="text-lg font-semibold text-gray-800">{{ number_format($repository->file_size / 1024, 2) }} KB</p>
        </div>
        <div class="bg-gray-50 p-4 rounded-lg">
            <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-2">Fecha de Subida</h3>
            <p class="text-lg font-semibold text-gray-800">{{ $repository->created_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <!-- Document Details -->
    <div class="space-y-6">
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-3">Información del Documento</h3>
            <div class="bg-gray-50 p-6 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Nombre del Archivo</p>
                        <p class="font-medium text-gray-800">{{ $repository->file_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Categoría</p>
                        <p class="font-medium text-gray-800">{{ $repository->category ?? 'Sin categoría' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Nivel de Grado</p>
                        <p class="font-medium text-gray-800">{{ $repository->grade_level ?? 'Todos' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Subido por</p>
                        <p class="font-medium text-gray-800">{{ $repository->uploader ? $repository->uploader->name : 'Desconocido' }}</p>
                    </div>
                </div>
                
                @if($repository->description)
                    <div class="mt-4">
                        <p class="text-sm text-gray-600">Descripción</p>
                        <p class="mt-1 text-gray-800 whitespace-pre-line">{{ $repository->description }}</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Preview/Download Section -->
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-3">Acciones</h3>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('admin.repository.download', $repository) }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    <i class="ri-download-line mr-2"></i>
                    Descargar Documento
                </a>
                <a href="{{ route('admin.repository.edit', $repository) }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    <i class="ri-pencil-line mr-2"></i>
                    Editar Documento
                </a>
                <form method="POST" action="{{ route('admin.repository.destroy', $repository) }}" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este documento?');" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="ri-delete-bin-line mr-2"></i>
                        Eliminar Documento
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection