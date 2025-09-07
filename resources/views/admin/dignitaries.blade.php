@extends('layouts.admin')

@section('title', 'Directorio de Dignatarios')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-6">Directorio de Dignatarios y Oficiales</h2>

                <!-- Filtros -->
                <div class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="filter-lodge" class="block text-sm font-medium text-gray-700">Filtrar por Logia</label>
                        <select id="filter-lodge" name="filter-lodge" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                            <option>Todas las Logias</option>
                            <option>Augusta y Resp. Logia Asilo de la Paz N° 13</option>
                            <option>Resp. Logia Aurora del Orinoco N° 23</option>
                            <option>Resp. Logia Dalla Costa N° 3</option>
                        </select>
                    </div>
                    <div>
                        <label for="filter-role" class="block text-sm font-medium text-gray-700">Filtrar por Cargo</label>
                        <select id="filter-role" name="filter-role" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                            <option>Todos los Cargos</option>
                            <option>Venerable Maestro</option>
                            <option>Primer Vigilante</option>
                            <option>Segundo Vigilante</option>
                            <option>Orador Fiscal</option>
                            <option>Secretario</option>
                            <option>Tesorero</option>
                        </select>
                    </div>
                    <div>
                        <label for="filter-grade" class="block text-sm font-medium text-gray-700">Filtrar por Grado</label>
                        <select id="filter-grade" name="filter-grade" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                            <option>Todos los Grados</option>
                            <option>Aprendiz</option>
                            <option>Compañero</option>
                            <option>Maestro</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="button" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Aplicar Filtros
                        </button>
                    </div>
                </div>

                <!-- Tabla de Dignatarios -->
                <div class="align-middle inline-block min-w-full">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cargo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logia</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grado</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contacto</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Juan Pérez</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Venerable Maestro</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Asilo de la Paz N° 13</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">Maestro Masón</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <i class="ri-mail-line mr-1"></i> juan.perez@email.com
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Carlos Rodríguez</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Secretario</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">Aurora del Orinoco N° 23</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">Maestro Masón</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <i class="ri-mail-line mr-1"></i> carlos.r@email.com
                                    </div>
                                </td>
                            </tr>
                            <!-- More people... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
