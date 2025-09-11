<div>
    <!-- Filters and Search -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="relative w-full md:w-1/3">
            <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-4 text-gray-400"></i>
            <input type="text" wire:model.live="search" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Buscar...">
        </div>

        <div class="flex flex-col md:flex-row items-center gap-4">
            <!-- Lodge Filter Dropdown -->
            <div class="relative">
                <i class="ri-bank-line absolute top-1/2 -translate-y-1/2 left-4 text-gray-400"></i>
                <select wire:model.live="filterLodgeId" class="w-full md:w-auto appearance-none bg-white border-2 border-gray-200 rounded-lg font-semibold text-gray-700 py-2 pl-12 pr-8 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 shadow-sm hover:border-primary-300 transition-colors">
                    <option value="">Filtrar por Logia</option>
                    @foreach ($lodges as $lodge)
                        <option value="{{ $lodge->id }}">{{ $lodge->name }} N° {{ $lodge->number }}</option>
                    @endforeach
                </select>
                <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-4 text-gray-400 pointer-events-none"></i>
            </div>

            <!-- Degree Filter Dropdown -->
            <div class="relative">
                <i class="ri-award-line absolute top-1/2 -translate-y-1/2 left-4 text-gray-400"></i>
                <select wire:model.live="filterDegree" class="w-full md:w-auto appearance-none bg-white border-2 border-gray-200 rounded-lg font-semibold text-gray-700 py-2 pl-12 pr-8 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 shadow-sm hover:border-primary-300 transition-colors">
                    <option value="">Filtrar por Grado</option>
                    @foreach ($degrees as $degree)
                        <option value="{{ $degree }}">{{ $degree }}</option>
                    @endforeach
                </select>
                <i class="ri-arrow-down-s-line absolute top-1/2 -translate-y-1/2 right-4 text-gray-400 pointer-events-none"></i>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white">
            <thead class="bg-primary-500">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer" wire:click="sortBy('name')">Nombre
                        @if ($sortField === 'name')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer" wire:click="sortBy('lodges.name')">Logia
                        @if ($sortField === 'lodges.name')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer" wire:click="sortBy('lodges.number')">Número
                        @if ($sortField === 'lodges.number')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer" wire:click="sortBy('degree')">Grado
                        @if ($sortField === 'degree')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer" wire:click="sortBy('email')">Email
                        @if ($sortField === 'email')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer" wire:click="sortBy('phone_number')">Teléfono
                        @if ($sortField === 'phone_number')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-white uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr class="odd:bg-white even:bg-primary-50 hover:bg-primary-100 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('admin.users.show', $user) }}" class="flex items-center cursor-pointer">
                                <div class="w-10 h-10 flex-shrink-0">
                                    <img class="w-10 h-10 rounded-full" src="https://i.pravatar.cc/150?u={{ $user->email }}" alt="Avatar de {{ $user->name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $user->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $user->lodges->first()->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $user->lodges->first()->number ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @php
                                $degree = $user->degree ?? 'N/A';
                                $class = 'text-gray-800 bg-gray-100';
                                if ($degree === 'Aprendiz') {
                                    $class = 'text-sky-800 bg-sky-100';
                                } elseif ($degree === 'Compañero') {
                                    $class = 'text-teal-800 bg-teal-100';
                                } elseif ($degree === 'Maestro') {
                                    $class = 'text-amber-800 bg-amber-100';
                                }
                            @endphp
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $class }}">
                                {{ $degree }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->phone_number ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="p-2 rounded-full bg-primary-100 text-primary-700 hover:bg-primary-200 hover:scale-110 transition-all" title="Editar">
                                    <i class="ri-pencil-line text-lg"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de que quieres eliminar a este usuario?');">
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
                        <td colspan="7" class="px-6 py-12 whitespace-nowrap text-center">
                            <div class="text-center">
                                <i class="ri-user-search-line text-6xl text-gray-300"></i>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No se encontraron usuarios</h3>
                                <p class="mt-1 text-sm text-gray-500">Intenta ajustar tu búsqueda o filtros.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $users->links() }}
    </div>
</div>