@extends('layouts.admin')
@section('title', 'Crear Categoría de Foro')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-6">Crear Nueva Categoría de Foro</h2>

                <form action="#" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="category-name" class="block text-sm font-medium text-gray-700">Nombre de la Categoría</label>
                            <input type="text" name="category-name" id="category-name" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label for="category-description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="category-description" id="category-description" rows="3" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                        </div>

                        <div>
                            <label for="category-permissions" class="block text-sm font-medium text-gray-700">Permisos de Acceso (Grado Mínimo)</label>
                            <select id="category-permissions" name="category-permissions" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                                <option>Todos (Público)</option>
                                <option>Aprendiz</option>
                                <option>Compañero</option>
                                <option>Maestro</option>
                                <option>Solo Administradores</option>
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('admin.forums.index') }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">Cancelar</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700">Guardar Categoría</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
