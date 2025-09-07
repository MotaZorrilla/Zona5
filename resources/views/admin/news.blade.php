@extends('layouts.admin')

@section('title', 'Gestión de Noticias')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Noticias</h1>
            <p class="text-sm text-gray-500 mt-1">Crea y administra las comunicaciones y artículos.</p>
        </div>
        <button class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-quill-pen-line mr-2"></i>
            <span>Escribir Noticia</span>
        </button>
    </div>

    <!-- Tabs for filtering -->
    <div class="mb-6 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500">
            <li class="mr-2">
                <a href="#" class="inline-flex items-center justify-center p-4 border-b-2 border-primary-500 text-primary-600 rounded-t-lg active group">
                    <i class="ri-check-double-line mr-2"></i>Publicadas (12)
                </a>
            </li>
            <li class="mr-2">
                <a href="#" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 group">
                    <i class="ri-draft-line mr-2"></i>Borradores (3)
                </a>
            </li>
            <li class="mr-2">
                <a href="#" class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 group">
                    <i class="ri-time-line mr-2"></i>Programadas (1)
                </a>
            </li>
        </ul>
    </div>

    <!-- News Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Autor</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Publicación</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Sample Row 1 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">La Masonería en la Era Digital</div>
                        <div class="text-xs text-gray-500">#tecnologia #sociedad</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Héctor Mota</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Reflexión</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600">01/09/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-primary-600 hover:text-primary-900 mr-4" title="Editar"><i class="ri-pencil-line text-lg"></i></a>
                        <a href="#" class="text-green-600 hover:text-green-900 mr-4" title="Previsualizar"><i class="ri-eye-line text-lg"></i></a>
                        <a href="#" class="text-red-600 hover:text-red-900" title="Eliminar"><i class="ri-delete-bin-line text-lg"></i></a>
                    </td>
                </tr>
                <!-- Sample Row 2 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-semibold text-gray-900">Resumen de la Tenida de Solsticio</div>
                        <div class="text-xs text-gray-500">#evento #solsticio</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Carlos Rodriguez</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Eventos</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600">25/08/2025</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-primary-600 hover:text-primary-900 mr-4" title="Editar"><i class="ri-pencil-line text-lg"></i></a>
                        <a href="#" class="text-green-600 hover:text-green-900 mr-4" title="Previsualizar"><i class="ri-eye-line text-lg"></i></a>
                        <a href="#" class="text-red-600 hover:text-red-900" title="Eliminar"><i class="ri-delete-bin-line text-lg"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-between items-center">
        <div class="text-sm text-gray-600">
            Mostrando <span class="font-bold">1</span> a <span class="font-bold">10</span> de <span class="font-bold">12</span> resultados
        </div>
        <div class="flex items-center">
            <a href="#" class="px-3 py-1 border rounded-lg hover:bg-gray-100">Anterior</a>
            <div class="mx-2">
                <a href="#" class="px-3 py-1 border rounded-lg bg-primary-500 text-white">1</a>
            </div>
            <a href="#" class="px-3 py-1 border rounded-lg hover:bg-gray-100">Siguiente</a>
        </div>
    </div>
</div>
@endsection
