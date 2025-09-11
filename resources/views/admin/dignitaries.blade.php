@extends('layouts.admin')

@section('title', 'Directorio de Dignatarios')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Directorio de Dignatarios de la Zona 5 -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Directorio de Dignatarios</h1>
            <p class="text-sm text-gray-500 mt-1">Gestiona los dignatarios de la Zona 5 y visualiza los Venerables Maestros de cada logia.</p>
        </div>
        <a href="{{ route('admin.zone-dignitaries.create') }}" class="inline-flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors ease-in-out duration-150">
            <i class="ri-add-line mr-2"></i>
            <span>Crear Nuevo Dignatario</span>
        </a>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Junta Directiva de la Zona 5</h2>
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cargo</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($dignitaries as $dignitary)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $dignitary->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $dignitary->role }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.zone-dignitaries.edit', $dignitary) }}" class="text-primary-600 hover:text-primary-800 font-semibold mr-4">Editar</a>
                                <form action="{{ route('admin.zone-dignitaries.destroy', $dignitary) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-semibold" onclick="return confirm('¿Estás seguro de que quieres eliminar este dignatario?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Venerables Maestros por Logia</h2>
        <livewire:admin.zone-dignitaries.manage-venerable-masters :key="time()" />
    </div>
</div>
@endsection
