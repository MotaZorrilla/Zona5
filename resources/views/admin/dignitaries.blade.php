@extends('layouts.admin')

@section('title', 'Directorio de Dignatarios')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Directorio de Dignatarios de la Zona 5 -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-primary-600">Directorio de Dignatarios</h1>
            <p class="text-sm text-gray-500 mt-1">Gestiona los dignatarios de la Zona 5 y visualiza los Venerables Maestros de cada logia.</p>
        </div>
        <a href="{{ route('admin.zone-dignitaries.create') }}" class="inline-flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors ease-in-out duration-150">
            <i class="ri-add-line mr-2"></i>
            <span>Crear Nuevo Dignatario</span>
        </a>
    </div>

    <!-- Filters Section -->
    <div class="bg-gray-50 p-4 rounded-lg mb-6">
        <form method="GET" action="{{ route('admin.zone-dignitaries.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <!-- Search -->
            <div class="md:col-span-2">
                <label class="block text-xs font-medium text-gray-700 mb-1">Buscar</label>
                <div class="relative">
                    <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
                    <input type="search" name="search" value="{{ request('search') }}" placeholder="Buscar dignatarios..." class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" />
                </div>
            </div>
            
            <!-- Role Filter -->
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Cargo</label>
                <select name="role" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                    <option value="">Todos los cargos</option>
                    @php
                        $roles = collect($dignitaries)->pluck('role')->unique();
                    @endphp
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" {{ request('role') == $role ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Apply Filters Button -->
            <div class="flex items-end">
                <div class="w-full flex space-x-2">
                    <button type="submit" class="flex-1 bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
                        Filtrar
                    </button>
                    <a href="{{ route('admin.zone-dignitaries.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
                        Limpiar
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-700 mb-6">Junta Directiva de la Zona 5</h2>
        <div class="overflow-x-auto rounded-lg border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-primary-500">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Cargo</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-white uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($dignitaries as $dignitary)
                        <tr class="odd:bg-white even:bg-primary-50 hover:bg-primary-100 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 flex-shrink-0 bg-primary-100 rounded-full flex items-center justify-center">
                                        <i class="ri-user-star-line text-primary-500"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $dignitary->name }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $dignitary->role }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.zone-dignitaries.edit', $dignitary) }}" class="p-2 rounded-full bg-primary-100 text-primary-700 hover:bg-primary-200 hover:scale-110 transition-all" title="Editar">
                                        <i class="ri-pencil-line text-lg"></i>
                                    </a>
                                    <form action="{{ route('admin.zone-dignitaries.destroy', $dignitary) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este dignatario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-full bg-red-100 text-red-700 hover:bg-red-200 hover:scale-110 transition-all" title="Eliminar">
                                            <i class="ri-delete-bin-line text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 whitespace-nowrap text-center">
                                <div class="text-center">
                                    <i class="ri-user-star-line text-6xl text-gray-300"></i>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No se encontraron dignatarios</h3>
                                    <p class="mt-1 text-sm text-gray-500">Aún no hay dignatarios registrados en la Junta Directiva.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('admin.zone-dignitaries.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                            <i class="ri-add-line mr-2"></i>
                                            Crear Nuevo Dignatario
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
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
