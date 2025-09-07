@extends('layouts.admin')

@section('title', 'Gestión de Logias')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Logias</h1>
            <p class="text-sm text-gray-500 mt-1">Crea, edita y administra las logias de la Gran Zona 5.</p>
        </div>
        <button class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-add-line mr-2"></i>
            <span>Crear Nueva Logia</span>
        </button>
    </div>

    <!-- Filters and Search -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="relative w-full md:w-1/3">
            <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
            <input type="text" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-400" placeholder="Buscar logia por nombre o número...">
        </div>
        <div class="flex items-center gap-4">
            <select class="bg-gray-50 border border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-400">
                <option>Filtrar por Valle</option>
                <option>Caracas</option>
                <option>Maracay</option>
                <option>Valencia</option>
            </select>
            <select class="bg-gray-50 border border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-400">
                <option>Filtrar por Estado</option>
                <option>Activa</option>
                <option>Suspendida</option>
            </select>
        </div>
    </div>

    <!-- Lodges Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Número</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Valle</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Miembros</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Sample Row 1 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex-shrink-0 bg-primary-100 rounded-full flex items-center justify-center">
                                <i class="ri-bank-line text-primary-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-gray-900">Estrella de Oriente</div>
                                <div class="text-xs text-gray-500">oriente@granlogia.org.ve</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">123</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Caracas</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">35 / 40</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Activa
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-primary-600 hover:text-primary-900 mr-4" title="Editar"><i class="ri-pencil-line text-lg"></i></a>
                        <a href="#" class="text-red-600 hover:text-red-900" title="Eliminar"><i class="ri-delete-bin-line text-lg"></i></a>
                    </td>
                </tr>
                <!-- Sample Row 2 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex-shrink-0 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="ri-bank-line text-green-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-gray-900">Domingo F. Sarmiento</div>
                                <div class="text-xs text-gray-500">sarmiento@granlogia.org.ve</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">45</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Maracay</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">28 / 40</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            Activa
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-primary-600 hover:text-primary-900 mr-4" title="Editar"><i class="ri-pencil-line text-lg"></i></a>
                        <a href="#" class="text-red-600 hover:text-red-900" title="Eliminar"><i class="ri-delete-bin-line text-lg"></i></a>
                    </td>
                </tr>
                <!-- Sample Row 3 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex-shrink-0 bg-yellow-100 rounded-full flex items-center justify-center">
                                <i class="ri-bank-line text-yellow-500"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-gray-900">Sol de Guayana</div>
                                <div class="text-xs text-gray-500">guayana@granlogia.org.ve</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">88</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Ciudad Guayana</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">25 / 40</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                            Suspendida
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="#" class="text-primary-600 hover:text-primary-900 mr-4" title="Editar"><i class="ri-pencil-line text-lg"></i></a>
                        <a href="#" class="text-red-600 hover:text-red-900" title="Eliminar"><i class="ri-delete-bin-line text-lg"></i></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-between items-center">
        <div class="text-sm text-gray-600">
            Mostrando <span class="font-bold">1</span> a <span class="font-bold">10</span> de <span class="font-bold">50</span> resultados
        </div>
        <div class="flex items-center">
            <a href="#" class="px-3 py-1 border rounded-lg hover:bg-gray-100">Anterior</a>
            <div class="mx-2">
                <a href="#" class="px-3 py-1 border rounded-lg bg-primary-500 text-white">1</a>
                <a href="#" class="px-3 py-1 border rounded-lg hover:bg-gray-100">2</a>
                <a href="#" class="px-3 py-1 border rounded-lg hover:bg-gray-100">3</a>
            </div>
            <a href="#" class="px-3 py-1 border rounded-lg hover:bg-gray-100">Siguiente</a>
        </div>
    </div>
</div>
@endsection
