@extends('layouts.admin')
@section('title', 'Añadir Nuevo Curso')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-bold mb-6">Añadir Nuevo Curso a la Escuela Virtual</h2>

                <form action="#" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label for="course-name" class="block text-sm font-medium text-gray-700">Nombre del Curso</label>
                            <input type="text" name="course-name" id="course-name" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Ej: Simbolismo del Grado de Aprendiz">
                        </div>

                        <div>
                            <label for="course-description" class="block text-sm font-medium text-gray-700">Descripción Corta</label>
                            <textarea name="course-description" id="course-description" rows="3" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Un breve resumen del contenido y objetivos del curso."></textarea>
                        </div>

                        <div>
                            <label for="course-instructor" class="block text-sm font-medium text-gray-700">Instructor(es)</label>
                            <input type="text" name="course-instructor" id="course-instructor" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="Ej: Q∴H∴ Nombre Apellido o Comisión de Docencia">
                        </div>

                        <div>
                            <label for="course-link" class="block text-sm font-medium text-gray-700">Enlace a la Plataforma Externa</label>
                            <input type="url" name="course-link" id="course-link" class="mt-1 focus:ring-primary-500 focus:border-primary-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" placeholder="https://plataforma-cursos.com/...">
                        </div>
                        
                        <div>
                            <label for="course-status" class="block text-sm font-medium text-gray-700">Estado</label>
                            <select id="course-status" name="course-status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm rounded-md">
                                <option value="active">Activo</option>
                                <option value="inactive">Inactivo</option>
                            </select>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('admin.school.index') }}" class="mr-4 inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-gray-300">Cancelar</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-700">Guardar Curso</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
