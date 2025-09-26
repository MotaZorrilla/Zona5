@extends('layouts.admin')
@section('title', 'Gestión de Foros')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-primary-600 mb-2">Gestión de Foros</h1>
            <p class="text-sm text-gray-500">Gestiona las categorías y discusiones del foro.</p>
        </div>
        <a href="{{ route('admin.forums.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700">
            Crear Categoría
        </a>
    </div>

    <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 bg-white border-b border-gray-200">
            <h3 class="text-lg font-semibold text-primary-600 mb-4">Categorías del Foro</h3>
            <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estadísticas</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Simbolismo del Grado de Aprendiz</div>
                                <div class="text-sm text-gray-500">Discusiones sobre los símbolos y enseñanzas del primer grado.</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div>15 Hilos</div>
                                <div>120 Mensajes</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-primary-600 hover:text-primary-900">Editar</a>
                                <a href="#" class="ml-4 text-red-600 hover:text-red-900">Eliminar</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Historia de la Masonería</div>
                                <div class="text-sm text-gray-500">Debates e investigaciones sobre la historia de la orden.</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div>8 Hilos</div>
                                <div>75 Mensajes</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-primary-600 hover:text-primary-900">Editar</a>
                                <a href="#" class="ml-4 text-red-600 hover:text-red-900">Eliminar</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
