<div x-data="{ showEditModal: @entangle('showEditModal').live }">
    <!-- Search and Filters -->
    <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="relative w-full md:w-1/3">
            <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-4 text-gray-400"></i>
            <input type="text" wire:model.live="search" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 pl-12 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Buscar...">
        </div>
    </div>

    <div class="overflow-x-auto rounded-lg border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 bg-white">
            <thead class="bg-primary-500">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer" wire:click="sortBy('name')">Nombre
                        @if ($sortBy === 'name')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer" wire:click="sortBy('lodge_name')">Logia
                        @if ($sortBy === 'lodge_name')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer" wire:click="sortBy('lodge_number')">Número
                        @if ($sortBy === 'lodge_number')
                            <i class="ri-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider">Contacto</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-white uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($venerableMasters as $vm)
                    <tr class="odd:bg-white even:bg-primary-50 hover:bg-primary-100 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-900">{{ $vm->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $vm->lodge_name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $vm->lodge_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $vm->phone_number ?? 'No disponible' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="openEditModal({{ $vm->id }})" class="p-2 rounded-full bg-primary-100 text-primary-700 hover:bg-primary-200 hover:scale-110 transition-all" title="Editar">
                                    <i class="ri-pencil-line text-lg"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 whitespace-nowrap text-center">
                            <div class="text-center">
                                <i class="ri-user-search-line text-6xl text-gray-300"></i>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No se encontraron Venerables Maestros</h3>
                                <p class="mt-1 text-sm text-gray-500">Intenta ajustar tu búsqueda o filtros.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full flex items-center justify-center z-50" x-show="showEditModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg shadow-lg" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <h3 class="text-2xl font-bold mb-4">Editar Venerable Maestro</h3>
            <form wire:submit.prevent="updateVenerableMaster">
                <div class="mb-4">
                    <label for="editingVmName" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                    <input type="text" id="editingVmName" wire:model.live="editingVmName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="editingVmLodgeName" class="block text-gray-700 text-sm font-bold mb-2">Logia:</label>
                    <input type="text" id="editingVmLodgeName" wire:model.live="editingVmLodgeName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
                </div>
                <div class="mb-4">
                    <label for="editingVmPhoneNumber" class="block text-gray-700 text-sm font-bold mb-2">Teléfono:</label>
                    <input type="text" id="editingVmPhoneNumber" wire:model.live="editingVmPhoneNumber" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-4">
                    <label for="selectedNewVmId" class="block text-gray-700 text-sm font-bold mb-2">Cambiar Venerable Maestro:</label>
                    <select id="selectedNewVmId" wire:model.live="selectedNewVmId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Seleccionar nuevo Venerable Maestro</option>
                        @foreach ($lodgeMembers as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="button" @click="showEditModal = false" wire:click="closeEditModal" class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded-lg mr-2">Cancelar</button>
                    <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>