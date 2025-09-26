@extends('layouts.admin')
@section('title', 'Escuela Virtual')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-primary-600 mb-2">Gestor de Cursos - Escuela Virtual</h1>
            <p class="text-sm text-gray-500">Gestiona los cursos virtuales y materiales educativos.</p>
        </div>
        <a href="{{ route('admin.school.create') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring ring-primary-300 disabled:opacity-25 transition ease-in-out duration-150">
            Añadir Curso
        </a>
    </div>

    <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 bg-white border-b border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Instructor</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- Ejemplo de curso activo --}}
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Oratoria Masónica</div>
                                <div class="text-sm text-gray-500">Fundamentos de la elocuencia.</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Q∴H∴ Héctor Mota</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Activo</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-primary-600 hover:text-primary-900">Editar</a>
                                <a href="http://extern-platform.com/curso/1" target="_blank" class="ml-4 text-blue-600 hover:text-blue-900">Ver Curso</a>
                            </td>
                        </tr>
                        {{-- Ejemplo de curso inactivo --}}
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">Administración de Logias</div>
                                <div class="text-sm text-gray-500">Para nuevos dignatarios.</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Comisión de Docencia</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactivo</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-primary-600 hover:text-primary-900">Editar</a>
                                <a href="http://extern-platform.com/curso/2" target="_blank" class="ml-4 text-blue-600 hover:text-blue-900">Ver Curso</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
