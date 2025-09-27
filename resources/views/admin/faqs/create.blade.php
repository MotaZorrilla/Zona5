@extends('layouts.admin')

@section('title', 'Crear Pregunta Frecuente')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-primary-600 mb-2">Crear Pregunta Frecuente</h1>
        <p class="text-sm text-gray-500">Agrega una nueva pregunta frecuente para el sitio público.</p>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Pregunta -->
            <div class="md:col-span-2">
                <label for="question" class="block text-sm font-medium text-gray-700 mb-2">Pregunta *</label>
                <input type="text" id="question" name="question" value="{{ old('question') }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('question') border-red-500 @enderror"
                       placeholder="Escribe la pregunta..." required>
                @error('question')
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
                        <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Orden -->
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Orden</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}" min="0"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500">
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Respuesta -->
            <div class="md:col-span-2">
                <label for="answer" class="block text-sm font-medium text-gray-700 mb-2">Respuesta *</label>
                <textarea id="answer" name="answer" rows="6"
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 @error('answer') border-red-500 @enderror"
                          placeholder="Escribe la respuesta..." required>{{ old('answer') }}</textarea>
                @error('answer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activa -->
            <div class="flex items-center">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                    Pregunta activa
                </label>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('admin.faqs.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Cancelar
            </a>
            <button type="submit" class="px-4 py-2 bg-primary-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Crear Pregunta
            </button>
        </div>
    </form>
</div>
@endsection