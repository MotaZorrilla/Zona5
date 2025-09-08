@extends('layouts.admin')

@section('title', 'Editar Logia')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Editar Logia</h1>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <div class="bg-primary-600 text-white p-4 rounded-t-lg mb-6">
            <h2 class="text-xl font-bold">Información de la Logia</h2>
        </div>
        <form action="{{ route('admin.lodges.update', $lodge) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="name" id="name" value="{{ $lodge->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="number" class="block text-sm font-medium text-gray-700">Número</label>
                <input type="number" name="number" id="number" value="{{ $lodge->number }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="oriente" class="block text-sm font-medium text-gray-700">Oriente</label>
                <input type="text" name="oriente" id="oriente" value="{{ $lodge->oriente }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="history" class="block text-sm font-medium text-gray-700">Historia (para la página pública)</label>
                <textarea name="history" id="history" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">{{ $lodge->history }}</textarea>
            </div>
            <div class="mb-4">
                <label for="image_url" class="block text-sm font-medium text-gray-700">Imagen (para la página pública)</label>
                <div x-data="{ imagePreview: '{{ $lodge->image_url ? Storage::url($lodge->image_url) : null }}', handleDrop(e) { this.imagePreview = URL.createObjectURL(e.dataTransfer.files[0]); this.$refs.fileInput.files = e.dataTransfer.files; } }" 
                     @dragover.prevent @drop="handleDrop" 
                     class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md cursor-pointer hover:border-primary-500">
                    <div class="space-y-1 text-center">
                        <template x-if="imagePreview">
                            <img :src="imagePreview" class="mx-auto h-32 w-32 object-cover rounded-md">
                        </template>
                        <template x-if="!imagePreview">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </template>
                        <div class="flex text-sm text-gray-600">
                            <label for="image_url" class="relative cursor-pointer bg-white rounded-md font-medium text-primary-600 hover:text-primary-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500">
                                <span>Sube un archivo</span>
                                <input id="image_url" x-ref="fileInput" name="image_url" type="file" class="sr-only" @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                            </label>
                            <p class="pl-1">o arrastra y suelta</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 2MB. Deja en blanco para mantener la imagen actual.</p>
                    </div>
                </div>
            </div>
            <div class="mt-6 flex justify-end">
                <x-danger-button href="{{ route('admin.lodges.index') }}" class="mr-2">Cancelar</x-danger-button>
                <x-primary-button type="submit">Actualizar</x-primary-button>
            </div>
        </form>
    </div>
@endsection