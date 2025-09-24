@extends('layouts.admin')

@section('title', 'Editar Documento - Repositorio')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Editar Documento</h1>
        <p class="text-sm text-gray-500 mt-1">Modifica la información del documento en el repositorio.</p>
    </div>

    <form action="{{ route('admin.repository.update', $repository) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-bold text-gray-700 mb-1">Título del Documento *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $repository->title) }}" required
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                   placeholder="Ingrese el título del documento">
            @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-bold text-gray-700 mb-1">Descripción</label>
            <textarea id="description" name="description" rows="3"
                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors"
                      placeholder="Ingrese una descripción del documento">{{ old('description', $repository->description) }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Current File Info -->
        <div>
            <label class="block text-sm font-bold text-gray-700 mb-1">Archivo Actual</label>
            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                @if($repository->file_type == 'pdf')
                    <i class="ri-file-pdf-2-line text-2xl text-red-500 mr-3"></i>
                @elseif(in_array($repository->file_type, ['doc', 'docx']))
                    <i class="ri-file-word-2-line text-2xl text-blue-500 mr-3"></i>
                @elseif(in_array($repository->file_type, ['xls', 'xlsx']))
                    <i class="ri-file-excel-2-line text-2xl text-green-500 mr-3"></i>
                @elseif(in_array($repository->file_type, ['ppt', 'pptx']))
                    <i class="ri-file-ppt-2-line text-2xl text-orange-500 mr-3"></i>
                @elseif(in_array($repository->file_type, ['jpg', 'jpeg', 'png']))
                    <i class="ri-image-2-line text-2xl text-purple-500 mr-3"></i>
                @else
                    <i class="ri-file-3-line text-2xl text-gray-500 mr-3"></i>
                @endif
                <div>
                    <p class="font-medium">{{ $repository->file_name }}</p>
                    <p class="text-sm text-gray-500">{{ number_format($repository->file_size / 1024, 2) }} KB | {{ strtoupper($repository->file_type) }}</p>
                </div>
            </div>
        </div>

        <!-- New File Upload -->
        <div>
            <label for="document" class="block text-sm font-bold text-gray-700 mb-1">Reemplazar Archivo</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg">
                <div class="space-y-1 text-center">
                    <div class="flex text-sm text-gray-600">
                        <label for="document" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                            <span>Seleccionar nuevo archivo</span>
                            <input id="document" name="document" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">o arrastrar y soltar</p>
                    </div>
                    <p class="text-xs text-gray-500">PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, TXT, JPG, JPEG, PNG hasta 10MB</p>
                </div>
            </div>
            <p class="mt-1 text-xs text-gray-500">Dejar vacío si no desea cambiar el archivo</p>
            @error('document')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category -->
        <div>
            <label for="category" class="block text-sm font-bold text-gray-700 mb-1">Categoría</label>
            <select id="category" name="category"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                <option value="">Seleccione una categoría</option>
                <option value="Ritual y Liturgia" {{ old('category', $repository->category) == 'Ritual y Liturgia' ? 'selected' : '' }}>Ritual y Liturgia</option>
                <option value="Administración" {{ old('category', $repository->category) == 'Administración' ? 'selected' : '' }}>Administración</option>
                <option value="Historia y Filosofía" {{ old('category', $repository->category) == 'Historia y Filosofía' ? 'selected' : '' }}>Historia y Filosofía</option>
                <option value="Formación" {{ old('category', $repository->category) == 'Formación' ? 'selected' : '' }}>Formación</option>
                <option value="Otros" {{ old('category', $repository->category) == 'Otros' ? 'selected' : '' }}>Otros</option>
            </select>
            @error('category')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Grade Level -->
        <div>
            <label for="grade_level" class="block text-sm font-bold text-gray-700 mb-1">Nivel de Grado</label>
            <select id="grade_level" name="grade_level"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                <option value="Todos" {{ old('grade_level', $repository->grade_level) == 'Todos' ? 'selected' : '' }}>Todos</option>
                <option value="Aprendiz" {{ old('grade_level', $repository->grade_level) == 'Aprendiz' ? 'selected' : '' }}>Aprendiz</option>
                <option value="Compañero" {{ old('grade_level', $repository->grade_level) == 'Compañero' ? 'selected' : '' }}>Compañero</option>
                <option value="Maestro" {{ old('grade_level', $repository->grade_level) == 'Maestro' ? 'selected' : '' }}>Maestro</option>
            </select>
            @error('grade_level')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.repository.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Cancelar
            </a>
            <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Actualizar Documento
            </button>
        </div>
    </form>
</div>
@endsection