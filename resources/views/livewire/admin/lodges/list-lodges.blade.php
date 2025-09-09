<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Logias</h1>
            <p class="text-sm text-gray-500 mt-1">Crea, edita y administra las logias de la Gran Zona 5.</p>
        </div>
        <a href="{{ route('admin.lodges.create') }}" class="flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
            <i class="ri-add-line mr-2"></i>
            <span>Crear Nueva Logia</span>
        </a>
    </div>

    <!-- Filters and Search -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="relative w-full md:w-1/3">
            <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
            <input type="text" wire:model.live="search" class="w-full bg-gray-50 border border-gray-200 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-400" placeholder="Buscar logia por nombre, número u orient...">
        </div>
        <div class="flex items-center gap-4">
            <select wire:model.live="filterOrient" class="bg-gray-50 border border-gray-200 rounded-lg py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-primary-400">
                <option value="">Filtrar por Orient</option>
                @foreach ($orients as $orient)
                    <option value="{{ $orient }}">{{ $orient }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Lodges Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('name')">Nombre
                        @if ($sortField === 'name')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('number')">Número
                        @if ($sortField === 'number')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('orient')">Orient
                        @if ($sortField === 'orient')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('users_count')">Miembros
                        @if ($sortField === 'users_count')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($lodges as $lodge)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex-shrink-0 bg-primary-100 rounded-full flex items-center justify-center">
                                    <i class="ri-bank-line text-primary-500"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $lodge->name }}</div>
                                    <div class="text-xs text-gray-500">#{{ $lodge->number }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $lodge->number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $lodge->orient }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $lodge->users_count }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Activa
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.lodges.edit', $lodge) }}" class="text-primary-600 hover:text-primary-900 mr-4" title="Editar"><i class="ri-pencil-line text-lg"></i></a>
                            <form action="{{ route('admin.lodges.destroy', $lodge) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta logia?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Eliminar"><i class="ri-delete-bin-line text-lg"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                            No hay logias registradas. Para empezar, puedes <a href="{{ route('admin.lodges.create') }}" class="text-primary-600 hover:underline">crear una nueva</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $lodges->links() }}
    </div>
</div>