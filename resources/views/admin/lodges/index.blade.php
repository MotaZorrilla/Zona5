@extends('layouts.admin')

@section('title', 'Gestión de Logias')

@section('content')
<div class="flex h-[calc(100vh-150px)] bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-xl overflow-hidden border-gray-10">


    <!-- Contenido Principal -->
    <div class="flex-grow flex flex-col bg-white shadow-inner">
        <!-- Encabezado de sección -->
        <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-white to-indigo-50 sticky top-0 bg-white z-10 shadow-sm">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-indigo-800 flex items-center gap-2">
                        <i class="ri-bank-line"></i> Gestión de Logias
                    </h1>
                    <p class="text-sm text-gray-600 mt-1">Administra las logias y sus detalles.</p>
                </div>
            </div>
            <div class="relative mt-4">
                <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400 text-lg"></i>
                <input type="search" name="search" placeholder="Buscar logias..." class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-4 transition-all shadow-sm focus:shadow-md" />
            </div>
        <!-- Lista de elementos -->
        <div class="overflow-y-auto flex-grow p-5">
            <livewire:admin.lodges.list-lodges />
        </div>
    </div>
</div>
@endsection