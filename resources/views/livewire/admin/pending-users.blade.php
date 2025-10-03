<div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
    <div class="bg-white shadow rounded-lg">
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <h3 class="text-lg leading-6 font-medium text-indigo-800 flex items-center">
                <i class="ri-user-forbid-line mr-2 text-indigo-600"></i> Usuarios Pendientes de Aprobación
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Lista de usuarios que requieren revisión y aprobación</p>
        </div>
        
        <div class="p-6">
            <!-- Search Bar -->
            <div class="mb-6">
                <input
                    type="text"
                    wire:model.live="search"
                    placeholder="Buscar usuarios por nombre, email o ID..."
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-50"
                />
            </div>
            
            <!-- Users Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-20">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Nacional</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Registro</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">{{ $user->national_id ?? 'No especificado' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $user->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button
                                        wire:click="showApproveModal({{ $user->id }})"
                                        class="text-green-600 hover:text-green-900 mr-4"
                                    >
                                        Aprobar
                                    </button>
                                    <button
                                        wire:click="showRejectModal({{ $user->id }})"
                                        class="text-red-600 hover:text-red-900"
                                    >
                                        Rechazar
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-40" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 0-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 0-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                        </svg>
                                        <h3 class="mt-4 text-lg font-medium text-gray-900">No hay usuarios pendientes</h3>
                                        <p class="mt-2 text-sm text-gray-500 max-w-md">
                                            @if($search)
                                                No se encontraron usuarios pendientes que coincidan con "{{ $search }}".
                                            @else
                                                Actualmente no hay usuarios esperando aprobación.
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($users->count() > 0 || $users->hasPages())
            <div class="mt-6">
                {{ $users->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Approve Modal -->
@if($showApproveModal && $selectedUser)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">Aprobar Usuario</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        ¿Estás seguro de que deseas aprobar al usuario <strong>{{ $selectedUser->name }}</strong>?
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button
                        wire:click="approveUser({{ $selectedUser->id }})"
                        class="px-4 py-2 bg-green-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300 mr-2"
                    >
                        Aprobar
                    </button>
                    <button
                        wire:click="resetModal"
                        class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300"
                    >
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

<!-- Reject Modal -->
@if($showRejectModal && $selectedUser)
    <div class="fixed inset-0 bg-gray-60 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <h3 class="text-lg font-medium text-gray-900">Rechazar Usuario</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">
                        ¿Estás seguro de que deseas rechazar al usuario <strong>{{ $selectedUser->name }}</strong>?
                    </p>
                </div>
                <div class="items-center px-4 py-3">
                    <button
                        wire:click="rejectUser({{ $selectedUser->id }})"
                        class="px-4 py-2 bg-red-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 mr-2"
                    >
                        Rechazar
                    </button>
                    <button
                        wire:click="resetModal"
                        class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300"
                    >
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif