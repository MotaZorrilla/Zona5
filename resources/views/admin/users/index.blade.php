@extends('layouts.admin')

@section('title', 'Gestionar Usuarios')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Gestionar Usuarios</h1>
        <a href="{{ route('admin.users.create') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-lg shadow-md">Crear Usuario</a>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Nombre</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-center">Roles</th>
                    <th class="py-3 px-6 text-center">Logia</th>
                    <th class="py-3 px-6 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($users as $user)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $user->name }}</td>
                        <td class="py-3 px-6 text-left">{{ $user->email }}</td>
                        <td class="py-3 px-6 text-center">
                            @foreach ($user->roles as $role)
                                <span class="bg-indigo-200 text-indigo-800 py-1 px-3 rounded-full text-xs">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td class="py-3 px-6 text-center">{{ $user->lodge->name ?? 'N/A' }}</td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a href="{{ route('admin.users.edit', $user) }}" class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-500 mr-2 transform hover:text-blue-700 hover:scale-110">
                                    <i class="ri-pencil-line"></i>
                                </a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-500 transform hover:text-red-700 hover:scale-110">
                                        <i class="ri-delete-bin-line"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
