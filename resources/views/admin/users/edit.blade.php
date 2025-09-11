@extends('layouts.admin')

@section('title', 'Editar Miembro')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Editar Miembro</h1>
            <p class="text-sm text-gray-500 mt-1">Actualiza los detalles y afiliaciones de {{ $user->name }}.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-800 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
            <i class="ri-arrow-left-line text-lg mr-2"></i>
            Volver a la lista
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Columna Izquierda: Datos Personales y Roles --}}
            <div class="lg:col-span-2 space-y-8">
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <h2 class="text-xl font-bold text-gray-800 border-b pb-4 mb-6">Datos Personales</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                            <input type="text" name="name" id="name" value="{{ $user->name }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" required>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" required>
                        </div>
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nueva Contraseña</label>
                            <input type="password" name="password" id="password" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" placeholder="Dejar en blanco para no cambiar">
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <h2 class="text-xl font-bold text-gray-800 border-b pb-4 mb-6">Roles del Sistema</h2>
                    <div>
                        <label for="roles" class="block text-sm font-medium text-gray-700 mb-1">Asignar roles de acceso al sistema (Admin, etc.)</label>
                        <select name="roles[]" id="roles" multiple class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- Columna Derecha: Afiliaciones --}}
            <div class="lg:col-span-1 bg-white p-8 rounded-xl shadow-lg">
                <h2 class="text-xl font-bold text-gray-800 border-b pb-4 mb-6">Afiliaciones y Cargos</h2>
                
                <div class="space-y-4">
                    <h3 class="text-md font-semibold text-gray-700">Afiliaciones Actuales</h3>
                    @forelse ($user->lodges as $affiliation)
                        <div class="flex items-center justify-between bg-primary-50 p-3 rounded-lg border border-primary-200">
                            <div>
                                <p class="font-semibold text-primary-800">{{ $affiliation->name }}</p>
                                <p class="text-sm text-primary-700">{{ $affiliation->pivot->position_id ? $positions->find($affiliation->pivot->position_id)->name : 'Sin Cargo' }}</p>
                            </div>
                            <button type="button" class="p-1 rounded-full text-red-500 hover:bg-red-100 transition-colors" title="Eliminar Afiliación">
                                <i class="ri-delete-bin-line text-lg"></i>
                            </button>
                        </div>
                    @empty
                        <div class="text-center py-4 bg-gray-50 rounded-lg">
                            <i class="ri-information-line text-3xl text-gray-400"></i>
                            <p class="text-sm text-gray-500 mt-1">Sin afiliaciones activas.</p>
                        </div>
                    @endforelse
                </div>

                <hr class="my-6 border-gray-200">

                <div class="space-y-4">
                    <h3 class="text-md font-semibold text-gray-700">Añadir Nueva Afiliación</h3>
                    <div class="mb-4">
                        <label for="lodge_id" class="block text-sm font-medium text-gray-700 mb-1">Logia</label>
                        <select name="new_affiliation[lodge_id]" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                            <option value="">Seleccionar Logia</option>
                            @foreach ($lodges as $lodge)
                                <option value="{{ $lodge->id }}">{{ $lodge->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="position_id" class="block text-sm font-medium text-gray-700 mb-1">Cargo en esa Logia</label>
                        <select name="new_affiliation[position_id]" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
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
            <a href="{{ route('admin.users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg shadow-sm mr-4 transition-colors">Cancelar</a>
            <button type="submit" class="inline-flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
                <i class="ri-check-line mr-2"></i>
                <span>Guardar Cambios</span>
            </button>
        </div>
    </form>
@endsection
