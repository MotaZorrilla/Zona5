@extends('layouts.admin')

@section('title', 'Gestión de Miembros')

@section('content')
<div class="flex h-[calc(100vh-150px)] bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-xl overflow-hidden border-gray-10">

    <!-- Contenido Principal -->
    <div class="flex-grow flex flex-col bg-white shadow-inner">
        <!-- Encabezado de sección -->
        <div class="p-5 border-b border-gray-10 bg-gradient-to-r from-white to-indigo-50 sticky top-0 bg-white z-10 shadow-sm">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-indigo-800 flex items-center gap-2">
                        <i class="ri-user-line"></i> Gestión de Miembros
                    </h1>
                    <p class="text-sm text-gray-600 mt-1">Administra los usuarios, sus roles y grados.</p>
                </div>
                <div>
                    <a href="{{ route('admin.users.create') }}" class="inline-flex items-center bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white font-bold py-2.5 px-4 rounded-xl shadow-md transition-all transform hover:scale-105 duration-300">
                        <i class="ri-user-add-line mr-2"></i>
                        <span>Invitar Nuevo Miembro</span>
                    </a>
                </div>
            </div>

        <!-- Lista de elementos -->
        <div class="overflow-y-auto flex-grow p-5">
            @livewire('admin.users.manage-users')
        </div>
    </div>
</div>
@endsection
