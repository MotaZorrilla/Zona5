<div x-data="{ showEditModal: @entangle('showEditModal').live, showAddModal: @entangle('showAddModal').live }">
    <!-- Header with Add Button -->
    <div class="flex justify-between items-center mb-6">
        <h3 id="venerable-masters-table" class="text-lg font-medium text-gray-900">Venerables Maestros por Logia</h3>
        <button wire:click="openAddModal" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            <i class="ri-add-line mr-2"></i>
            Agregar Venerable Maestro
        </button>
    </div>
    <!-- Header with Add Button -->
    <div class="flex justify-between items-center mb-6">
        <h3 id="venerable-masters-table" class="text-lg font-medium text-gray-900">Venerables Maestros por Logia</h3>
        <button wire:click="openAddModal" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            <i class="ri-add-line mr-2"></i>
            Agregar Venerable Maestro
        </button>
    </div>

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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer" wire:click="order('name')">Nombre
                        @if ($orderBy === 'name')
                            <i class="ri-arrow-{{ $orderDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer" wire:click="order('lodge_name')">Logia
                        @if ($orderBy === 'lodge_name')
                            <i class="ri-arrow-{{ $orderDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
                        @endif
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider cursor-pointer" wire:click="order('lodge_number')">Número
                        @if ($orderBy === 'lodge_number')
                            <i class="ri-arrow-{{ $orderDirection === 'asc' ? 'up' : 'down' }}-line ml-1"></i>
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
                            <div class="flex items-center">
                                <div class="w-10 h-10 flex-shrink-0 bg-primary-100 rounded-full flex items-center justify-center">
                                    <i class="ri-user-star-line text-primary-500"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-gray-900">{{ $vm->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $vm->lodges->first()->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            {{ $vm->lodges->first()->number ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $vm->phone_number ?? 'No disponible' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <button wire:click="openEditModal({{ $vm->id }})" class="p-2 rounded-full bg-primary-100 text-primary-700 hover:bg-primary-200 hover:scale-110 transition-all" title="Editar">
                                    <i class="ri-pencil-line text-lg"></i>
                                </button>
                                <button wire:click="removeVenerableMaster({{ $vm->id }}, {{ $vm->lodges->first()->id ?? 'null' }})" class="p-2 rounded-full bg-red-100 text-red-700 hover:bg-red-200 hover:scale-110 transition-all" title="Remover Venerable Maestro" onclick="return confirm('¿Estás seguro de que quieres remover a este Venerable Maestro?')">
                                    <i class="ri-delete-bin-line text-lg"></i>
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

    <!-- Pagination -->
    <div class="mt-6">
        {{ $venerableMasters->onEachSide(1)->links() }}
    </div>

    <!-- Add Modal -->
    <div class="fixed inset-0 bg-gray-600 bg-opacity-75 overflow-y-auto h-full w-full flex items-center justify-center z-50" x-show="showAddModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="relative p-8 bg-white w-full max-w-md m-auto flex-col flex rounded-lg shadow-lg" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
            <h3 class="text-2xl font-bold mb-4">Agregar Venerable Maestro</h3>
            
            <div class="mb-4">
                <label for="selectedLodgeId" class="block text-gray-700 text-sm font-bold mb-2">Seleccionar Logia:</label>
                <select id="selectedLodgeId" wire:model.live="selectedLodgeId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <option value="">Seleccionar una logia</option>
                    @foreach ($lodges as $lodge)
                        <option value="{{ $lodge->id }}">{{ $lodge->name }} (#{{ $lodge->number }})</option>
                    @endforeach
                </select>
            </div>

            @if ($selectedLodgeId)
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Opción 1: Seleccionar de miembros existentes</label>
                    <select wire:model.live="selectedUserId" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Seleccionar un miembro</option>
                        @foreach ($lodgeMembers as $member)
                            <option value="{{ $member->id }}">{{ $member->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="relative flex items-center justify-center my-4">
                    <div class="flex-grow border-t border-gray-300"></div>
                    <span class="flex-shrink mx-4 text-gray-500">O</span>
                    <div class="flex-grow border-t border-gray-300"></div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Opción 2: Crear nuevo usuario</label>
                    <div class="mb-3">
                        <label for="newVmName" class="block text-gray-700 text-sm font-bold mb-2">Nombre:</label>
                        <input type="text" id="newVmName" wire:model.live="newVmName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Nombre completo">
                    </div>
                    <div class="mb-3">
                        <label for="newVmPhoneNumber" class="block text-gray-700 text-sm font-bold mb-2">Teléfono:</label>
                        <input type="text" id="newVmPhoneNumber" wire:model.live="newVmPhoneNumber" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Número de teléfono">
                    </div>
                </div>
            @endif

            <div class="flex justify-end gap-2">
                <button type="button" @click="showAddModal = false" wire:click="closeAddModal" class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded-lg mr-2">Cancelar</button>
                
                @if ($selectedUserId && $selectedLodgeId)
                    <button type="button" wire:click="addVenerableMaster" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg">
                        Asignar como Venerable Maestro
                    </button>
                @elseif ($newVmName && $selectedLodgeId)
                    <button type="button" wire:click="createNewUserAndMakeVm" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg">
                        Crear y Asignar como Venerable Maestro
                    </button>
                @endif
            </div>
        </div>
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