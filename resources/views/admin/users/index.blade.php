@extends('layouts.admin')

@section('title', 'Gestión de Miembros')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Miembros</h1>
            <p class="text-sm text-gray-500 mt-1">Administra los usuarios, sus roles y grados.</p>
        </div>
        <a href="{{ route('admin.users.create') }}" class="inline-flex items-center bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition-colors ease-in-out duration-150">
            <i class="ri-user-add-line mr-2"></i>
            <span>Invitar Nuevo Miembro</span>
        </a>
    </div>

    @livewire('admin.users.manage-users')
</div>
@endsection
