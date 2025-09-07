@extends('layouts.admin')

@section('title', 'Repositorio de Documentos')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Repositorio de Documentos</h1>
            <p class="text-sm text-gray-500 mt-1">Gestiona el material de estudio y administrativo.</p>
        </div>
        <button class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-upload-cloud-2-line mr-2"></i>
            <span>Subir Documento</span>
        </button>
    </div>

    <!-- Search and Filters -->
    <div class="mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="relative w-full md:w-2/3">
            <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
            <input type="text" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-400" placeholder="Buscar en el repositorio...">
        </div>
        <div class="flex items-center gap-4">
            <select class="bg-gray-50 border border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-400">
                <option>Filtrar por Grado</option>
                <option>Aprendiz (1)</option>
                <option>Compañero (2)</option>
                <option>Maestro (3)</option>
            </select>
        </div>
    </div>

    <!-- Category Folders -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6 mb-10">
        <div class="flex flex-col items-center justify-center p-4 bg-primary-50 rounded-lg text-center cursor-pointer hover:bg-primary-100 transition-colors">
            <i class="ri-folder-3-line text-5xl text-primary-400"></i>
            <span class="mt-2 text-sm font-semibold text-gray-700">Ritual y Liturgia</span>
        </div>
        <div class="flex flex-col items-center justify-center p-4 bg-green-50 rounded-lg text-center cursor-pointer hover:bg-green-100 transition-colors">
            <i class="ri-folder-3-line text-5xl text-green-400"></i>
            <span class="mt-2 text-sm font-semibold text-gray-700">Administración</span>
        </div>
        <div class="flex flex-col items-center justify-center p-4 bg-yellow-50 rounded-lg text-center cursor-pointer hover:bg-yellow-100 transition-colors">
            <i class="ri-folder-3-line text-5xl text-yellow-400"></i>
            <span class="mt-2 text-sm font-semibold text-gray-700">Historia y Filosofía</span>
        </div>
        <div class="flex flex-col items-center justify-center p-4 bg-pink-50 rounded-lg text-center cursor-pointer hover:bg-pink-100 transition-colors">
            <i class="ri-folder-3-line text-5xl text-pink-400"></i>
            <span class="mt-2 text-sm font-semibold text-gray-700">Formación</span>
        </div>
        <div class="flex flex-col items-center justify-center p-4 bg-gray-100 rounded-lg text-center cursor-pointer hover:bg-gray-200 transition-colors">
            <i class="ri-folder-add-line text-5xl text-gray-400"></i>
            <span class="mt-2 text-sm font-semibold text-gray-700">Nueva Categoría</span>
        </div>
    </div>

    <!-- Recent Documents List -->
    <div>
        <h3 class="text-xl font-bold text-gray-800 mb-4">Documentos Recientes</h3>
        <div class="space-y-4">
            <!-- Document Item 1 -->
            <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <i class="ri-file-pdf-2-line text-3xl text-red-500 mr-4"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Plancha de Arquitectura sobre el Simbolismo</p>
                        <p class="text-xs text-gray-500">Categoría: Historia y Filosofía | Grado: Maestro (3) | Subido por: Carlos Rodriguez</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-500">Hace 2h</span>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="text-gray-500 hover:text-gray-700"><i class="ri-more-2-fill"></i></button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-10 py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ver Detalles</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Descargar</a>
                            <a href="#" class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Document Item 2 -->
            <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <i class="ri-file-word-2-line text-3xl text-blue-500 mr-4"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Decreto N° 23-05</p>
                        <p class="text-xs text-gray-500">Categoría: Administración | Grado: Todos | Subido por: Héctor Mota</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-500">Ayer</span>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="text-gray-500 hover:text-gray-700"><i class="ri-more-2-fill"></i></button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-10 py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ver Detalles</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Descargar</a>
                            <a href="#" class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
