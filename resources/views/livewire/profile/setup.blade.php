<div class="max-w-4xl mx-auto p-6">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold font-serif text-gray-900">Configuración de Perfil</h2>
        <p class="text-sm text-gray-600">Completa tu información personal y de logia</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="saveProfile" class="space-y-6">
        <!-- Información Personal -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Información Personal</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="national_id" class="block text-sm font-medium text-gray-700 mb-1">ID Nacional</label>
                    <input 
                        type="text" 
                        id="national_id" 
                        wire:model="national_id" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-50"
                        required
                    />
                    @error('national_id') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Nacimiento</label>
                    <input 
                        type="date" 
                        id="birth_date" 
                        wire:model="birth_date" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                        required
                    />
                    @error('birth_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="initiation_date" class="block text-sm font-medium text-gray-700 mb-1">Fecha de Iniciación</label>
                    <input 
                        type="date" 
                        id="initiation_date" 
                        wire:model="initiation_date" 
                        class="w-full px-3 py-2 border border-gray-30 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                        required
                    />
                    @error('initiation_date') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="degree" class="block text-sm font-medium text-gray-700 mb-1">Grado</label>
                    <input 
                        type="text" 
                        id="degree" 
                        wire:model="degree" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                        required
                    />
                    @error('degree') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="profession" class="block text-sm font-medium text-gray-700 mb-1">Profesión</label>
                    <input 
                        type="text" 
                        id="profession" 
                        wire:model="profession" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                        required
                    />
                    @error('profession') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Número de Teléfono</label>
                    <input 
                        type="text" 
                        id="phone_number" 
                        wire:model="phone_number" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                        required
                    />
                    @error('phone_number') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Información de Logia -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Información de Logia</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="selected_lodge" class="block text-sm font-medium text-gray-700 mb-1">Logia</label>
                    <select 
                        id="selected_lodge" 
                        wire:model="selected_lodge" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                        required
                    >
                        <option value="">Selecciona una logia</option>
                        @if(isset($lodges) && $lodges->count() > 0)
                            @foreach($lodges as $lodge)
                                <option value="{{ $lodge->id }}">{{ $lodge->name }}</option>
                            @endforeach
                        @else
                            <option value="">No hay logias disponibles</option>
                        @endif
                    </select>
                    @error('selected_lodge') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="selected_position" class="block text-sm font-medium text-gray-700 mb-1">Cargo en la Logia</label>
                    <select 
                        id="selected_position" 
                        wire:model="selected_position" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary-500 focus:border-primary-500"
                        required
                    >
                        <option value="">Selecciona un cargo</option>
                        @if(isset($positions) && $positions->count() > 0)
                            @foreach($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                        @else
                            <option value="">No hay posiciones disponibles</option>
                        @endif
                    </select>
                    @error('selected_position') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <!-- Botón de Guardar -->
        <div class="flex justify-end">
            <button 
                type="submit" 
                class="px-6 py-3 bg-primary-60 text-white font-medium rounded-md hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
            >
                Guardar Perfil
            </button>
        </div>
    </form>
</div>