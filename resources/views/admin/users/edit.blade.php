@extends('layouts.admin')

@section('title', 'Editar Miembro')

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Editar Miembro</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Columna Izquierda: Datos Personales y Roles --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4">Datos Personales</h2>
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                        <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" placeholder="Dejar en blanco para no cambiar">
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h2 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4">Roles del Sistema</h2>
                    <div>
                        <label for="roles" class="block text-sm font-medium text-gray-700">Asignar roles de acceso al sistema (Admin, etc.)</label>
                        <select name="roles[]" id="roles" multiple class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Columna Derecha: Afiliaciones --}}
            <div class="lg:col-span-1 bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-4">Afiliaciones y Cargos</h2>
                
                <div class="space-y-4">
                    <h3 class="text-md font-semibold text-gray-700">Afiliaciones Actuales</h3>
                    @forelse ($user->lodges as $affiliation)
                        <div class="flex items-center justify-between bg-gray-50 p-3 rounded-md">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $affiliation->name }}</p>
                                <p class="text-sm text-primary-600">{{ $affiliation->pivot->position_id ? $positions->find($affiliation->pivot->position_id)->name : 'Sin Cargo' }}</p>
                            </div>
                            {{-- El botón de eliminar requerirá JS o un enfoque de formulario anidado --}}
                            <button type="button" class="text-red-500 hover:text-red-700">&times;</button>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500">Este miembro no tiene afiliaciones activas.</p>
                    @endforelse
                </div>

                <hr class="my-6">

                <div class="space-y-4">
                    <h3 class="text-md font-semibold text-gray-700">Añadir Nueva Afiliación</h3>
                    <div class="mb-4">
                        <label for="lodge_id" class="block text-sm font-medium text-gray-700">Logia</label>
                        <select name="new_affiliation[lodge_id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            <option value="">Seleccionar Logia</option>
                            @foreach ($lodges as $lodge)
                                <option value="{{ $lodge->id }}">{{ $lodge->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="position_id" class="block text-sm font-medium text-gray-700">Cargo en esa Logia</label>
                        <select name="new_affiliation[position_id]" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            <option value="">Seleccionar Cargo</option>
                            @foreach ($positions as $position)
                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex justify-end">
            <a href="{{ route('admin.users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg shadow-sm mr-2">Cancelar</a>
            <button type="submit" class="bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md">Guardar Cambios</button>
        </div>
    </form>
@endsection
