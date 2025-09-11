@extends('layouts.admin')

@section('title', 'Editar Dignatario de Zona')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Editar Dignatario de Zona</h1>
            <p class="text-sm text-gray-500 mt-1">Modifica los detalles del dignatario de la Zona 5.</p>
        </div>
        <a href="{{ route('admin.zone-dignitaries.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-800 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
            <i class="ri-arrow-left-line text-lg mr-2"></i>
            Volver a la lista
        </a>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-lg">
        <form action="{{ route('admin.zone-dignitaries.update', $zoneDignitary) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <h2 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-6">Información del Dignatario</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $zoneDignitary->name) }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" required>
                    </div>
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Cargo</label>
                        <input type="text" name="role" id="role" value="{{ old('role', $zoneDignitary->role) }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" required>
                    </div>
                    <div>
                        <label for="image_url" class="block text-sm font-medium text-gray-700 mb-1">URL de la Imagen (Opcional)</label>
                        <input type="url" name="image_url" id="image_url" value="{{ old('image_url', $zoneDignitary->image_url) }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                    </div>
                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Biografía (Opcional)</label>
                        <textarea name="bio" id="bio" rows="4" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">{{ old('bio', $zoneDignitary->bio) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-8">
                <a href="{{ route('admin.zone-dignitaries.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg shadow-sm mr-4 transition-colors">Cancelar</a>
                <button type="submit" class="inline-flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
                    <i class="ri-save-line mr-2"></i>
                    <span>Actualizar Dignatario</span>
                </button>
            </div>
        </form>
    </div>
@endsection
