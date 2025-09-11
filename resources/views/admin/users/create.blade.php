@extends('layouts.admin')

@section('title', 'Invitar Nuevo Miembro')

@section('content')
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Invitar Nuevo Miembro</h1>
            <p class="text-sm text-gray-500 mt-1">Completa los detalles para enviar una invitación.</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-gray-800 bg-gray-200 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
            <i class="ri-arrow-left-line text-lg mr-2"></i>
            Volver a la lista
        </a>
    </div>

    <div class="bg-white p-8 rounded-xl shadow-lg">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <h2 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-6">Información Básica</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nombre Completo</label>
                        <input type="text" name="name" id="name" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" id="email" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" required>
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña Provisional</label>
                        <input type="password" name="password" id="password" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors" required>
                    </div>
                </div>
            </div>

            <div class="pt-6">
                 <h2 class="text-lg font-semibold text-gray-800 border-b pb-3 mb-6">Asignación Inicial</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="roles" class="block text-sm font-medium text-gray-700 mb-1">Rol en el Sistema</label>
                        <select name="roles[]" id="roles" multiple class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="lodge_id" class="block text-sm font-medium text-gray-700 mb-1">Logia de Afiliación</label>
                        <select name="lodge_id" id="lodge_id" class="w-full bg-white border-2 border-gray-200 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors">
                            <option value="">Sin Logia</option>
                            @foreach ($lodges as $lodge)
                                <option value="{{ $lodge->id }}">{{ $lodge->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-8">
                <a href="{{ route('admin.users.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg shadow-sm mr-4 transition-colors">Cancelar</a>
                <button type="submit" class="inline-flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors">
                    <i class="ri-user-add-line mr-2"></i>
                    <span>Crear Miembro</span>
                </button>
            </div>
        </form>
    </div>
@endsection
