@extends('layouts.admin')

@section('title', 'Escribir Nueva Noticia')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Escribir Nueva Noticia</h1>
            <p class="text-sm text-gray-500 mt-1">Completa el formulario para publicar un nuevo artículo.</p>
        </div>
        <a href="{{ route('admin.news.index') }}" class="flex items-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-arrow-go-back-line mr-2"></i>
            <span>Cancelar y Volver</span>
        </a>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Título del Artículo</label>
            <input type="text" name="title" id="title" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
        </div>

        <!-- Excerpt -->
        <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700">Resumen (Extracto)</label>
            <textarea name="excerpt" id="excerpt" rows="3" required maxlength="255" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"></textarea>
            <p class="mt-2 text-xs text-gray-500">Este texto se mostrará en las vistas previas y listados. Máximo 255 caracteres.</p>
        </div>

        <!-- Content -->
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Contenido Principal</label>
            <textarea name="content" id="content" rows="10" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm"></textarea>
        </div>

        <!-- Image Upload -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Imagen Destacada</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <i class="ri-image-add-line text-4xl text-gray-400"></i>
                    <div class="flex text-sm text-gray-600">
                        <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                            <span>Sube un archivo</span>
                            <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                        </label>
                        <p class="pl-1">o arrástralo aquí</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 2MB</p>
                </div>
            </div>
        </div>

        <!-- PDF Upload -->
        <div>
            <label for="pdf" class="block text-sm font-medium text-gray-700">Documento PDF (Opcional)</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <i class="ri-file-pdf-line text-4xl text-gray-400"></i>
                    <div class="flex text-sm text-gray-600">
                        <label for="pdf" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                            <span>Sube un archivo</span>
                            <input id="pdf" name="pdf" type="file" class="sr-only" accept=".pdf">
                        </label>
                        <p class="pl-1">o arrástralo aquí</p>
                    </div>
                    <p class="text-xs text-gray-500">PDF hasta 5MB</p>
                </div>
            </div>
        </div>

        <!-- Status and Schedule -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="status" id="status" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                    <option value="draft">Borrador</option>
                    <option value="published">Publicar inmediatamente</option>
                    <option value="scheduled">Programar publicación</option>
                </select>
            </div>

            <div id="scheduled-date-container" class="hidden">
                <label for="published_at" class="block text-sm font-medium text-gray-700">Fecha de Publicación</label>
                <input type="datetime-local" name="published_at" id="published_at" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.news.index') }}" class="flex items-center bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
                <i class="ri-arrow-go-back-line mr-2"></i>
                <span>Cancelar</span>
            </a>
            <button type="submit" name="status" value="draft" class="flex items-center bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
                <i class="ri-draft-line mr-2"></i>
                <span>Guardar como Borrador</span>
            </button>
            <button type="submit" name="status" value="published" class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
                <i class="ri-send-plane-2-line mr-2"></i>
                <span>Publicar Noticia</span>
            </button>
        </div>
    </form>
</div>

<script>
    // Script para manejar la visibilidad del campo de fecha programada
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status');
        const scheduledDateContainer = document.getElementById('scheduled-date-container');
        
        statusSelect.addEventListener('change', function() {
            if (this.value === 'scheduled') {
                scheduledDateContainer.classList.remove('hidden');
            } else {
                scheduledDateContainer.classList.add('hidden');
            }
        });
    });
</script>
@endsection
