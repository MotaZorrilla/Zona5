@extends('layouts.admin')

@section('title', 'Editar Foro')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-primary-600 mb-2">Editar Foro</h1>
        <p class="text-sm text-gray-500">Modifica la configuración del foro seleccionado.</p>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.forums.update', $forum) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Título -->
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Título del Foro *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $forum->title) }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('title') border-red-500 @enderror"
                       placeholder="Ej: Discusiones Generales" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Categoría -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Categoría</label>
                <select id="category" name="category"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                    <option value="">Sin categoría</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $forum->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Orden -->
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Orden</label>
                <input type="number" id="order" name="order" value="{{ old('order', $forum->order) }}" min="0"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div class="md:col-span-2">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                <textarea id="description" name="description" rows="4"
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('description') border-red-500 @enderror"
                          placeholder="Describe el propósito y alcance de este foro...">{{ old('description', $forum->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Opciones -->
            <div class="space-y-4">
                <label class="block text-sm font-medium text-gray-700">Opciones</label>

                <div class="flex items-center">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $forum->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Foro activo
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="hidden" name="is_pinned" value="0">
                    <input type="checkbox" id="is_pinned" name="is_pinned" value="1" {{ old('is_pinned', $forum->is_pinned) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                    <label for="is_pinned" class="ml-2 block text-sm text-gray-900">
                        Foro pineado
                    </label>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('admin.forums.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 bg-primary-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Actualizar Foro
            </button>
        </div>
    </form>
</div>
@endsection