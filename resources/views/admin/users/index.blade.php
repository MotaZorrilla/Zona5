@extends('layouts.admin')

@section('title', 'Gestión de Miembros')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Miembros</h1>
            <p class="text-sm text-gray-500 mt-1">Administra los usuarios, sus roles y grados.</p>
        </div>
        <button class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-user-add-line mr-2"></i>
            <span>Invitar Nuevo Miembro</span>
        </button>
    </div>

    <!-- Filters and Search -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="relative w-full md:w-1/3">
            <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
            <input type="text" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-400" placeholder="Buscar por nombre o email...">
        </div>
        <div class="flex items-center gap-4">
            <select class="bg-gray-50 border border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-400">
                <option>Filtrar por Logia</option>
                <option>Estrella de Oriente</option>
                <option>Domingo F. Sarmiento</option>
            </select>
            <select class="bg-gray-50 border border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-400">
                <option>Filtrar por Rol</option>
                <option>SuperAdmin</option>
                <option>Admin</option>
                <option>Miembro</option>
            </select>
        </div>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logia</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grado</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <!-- Sample Row 1 -->
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="w-10 h-10 flex-shrink-0">
                                <img class="w-10 h-10 rounded-full" src="https://i.pravatar.cc/150?u=hector" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-gray-900">Héctor Mota</div>
                                <div class="text-xs text-gray-500">hector.mota@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Estrella de Oriente</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Maestro Masón (3)</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-pink-100 text-pink-800">
                            SuperAdmin
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
                            <div class="w-10 h-10 flex-shrink-0">
                                <img class="w-10 h-10 rounded-full" src="https://i.pravatar.cc/150?u=carlos" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-gray-900">Carlos Rodriguez</div>
                                <div class="text-xs text-gray-500">carlos.rodriguez@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Domingo F. Sarmiento</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Compañero (2)</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-primary-100 text-primary-800">
                            Admin
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
                            <div class="w-10 h-10 flex-shrink-0">
                                <img class="w-10 h-10 rounded-full" src="https://i.pravatar.cc/150?u=juan" alt="">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-gray-900">Juan Perez</div>
                                <div class="text-xs text-gray-500">juan.perez@example.com</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Sol de Guayana</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">Aprendiz (1)</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                            Miembro
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
            Mostrando <span class="font-bold">1</span> a <span class="font-bold">10</span> de <span class="font-bold">150</span> resultados
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
