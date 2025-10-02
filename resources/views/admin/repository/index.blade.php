@extends('layouts.admin')

@section('title', 'Gestión de Repositorio')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-2xl font-bold text-indigo-800 flex items-center gap-2">
                <i class="ri-archive-2-line"></i> Gestión de Repositorio
            </h1>
            <p class="text-sm text-gray-600 mt-1">Gestiona los documentos y recursos de la Gran Zona.</p>
        </div>
        <a href="{{ route('admin.repository.create') }}" class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-add-line mr-2"></i>
            <span>Agregar Documento</span>
        </a>
    </div>

    <div class="text-center py-12">
        <i class="ri-archive-2-line text-5xl text-gray-300 mb-4"></i>
        <h3 class="text-xl font-medium text-gray-500 mb-2">Repositorio de Documentos</h3>
        <p class="text-gray-400 mb-4">Aquí se mostrarán los documentos del repositorio.</p>
        <a href="{{ route('admin.repository.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
            <i class="ri-add-line mr-2"></i>
            Subir Documento
        </a>
    </div>
</div>
@endsection