@extends('layouts.admin')

@section('title', 'Gestión de Logias')

@section('content')
<div class="flex h-[calc(100vh-150px)] bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl shadow-xl overflow-hidden border-gray-10">

    <!-- Sidebar de Navegación -->
    <aside class="w-72 bg-gradient-to-b from-indigo-700 to-purple-800 text-white p-5 flex-shrink-0 shadow-lg">
        <div class="mb-8">
            <h2 class="text-2xl font-bold flex items-center gap-2">
                <i class="ri-building-2-line text-xl"></i> Administración
            </h2>
        </div>
        
        <div class="mb-6">
            <a href="{{ route('admin.lodges.create') }}" class="w-full flex items-center justify-center bg-gradient-to-r from-cyan-500 to-blue-500 hover:from-cyan-600 hover:to-blue-600 text-white font-bold py-4 px-5 rounded-xl shadow-lg transition-all transform hover:scale-105 duration-300 flex items-center gap-2">
                <i class="ri-add-line text-lg"></i>
                <span>Nueva Logia</span>
            </a>
        </div>
        
        <nav class="space-y-1 mt-6">
            <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-600 rounded-xl transition-all duration-300 hover:text-white group">
                <i class="ri-user-line mr-3 text-xl group-hover:text-blue-300 transition-colors"></i>
                <span>Miembros</span>
            </a>
            <a href="{{ route('admin.lodges.index') }}" class="flex items-center px-4 py-3 text-white font-semibold bg-indigo-60 rounded-xl mb-1 transition-all duration-300 hover:bg-indigo-500 shadow-md">
                <i class="ri-building-2-line mr-3 text-xl"></i>
                <span>Logias</span>
            </a>
            <a href="{{ route('admin.news.index') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-600 rounded-xl transition-all duration-300 hover:text-white group">
                <i class="ri-newspaper-line mr-3 text-xl group-hover:text-green-300 transition-colors"></i>
                <span>Noticias</span>
            </a>
            <a href="{{ route('admin.events.index') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-600 rounded-xl transition-all duration-300 hover:text-white group">
                <i class="ri-calendar-event-line mr-3 text-xl group-hover:text-purple-300 transition-colors"></i>
                <span>Eventos</span>
            </a>
            <a href="{{ route('admin.treasury.index') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-600 rounded-xl transition-all duration-300 hover:text-white group">
                <i class="ri-bank-line mr-3 text-xl group-hover:text-yellow-300 transition-colors"></i>
                <span>Tesorería</span>
            </a>
            <a href="{{ route('admin.repository.index') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-600 rounded-xl transition-all duration-300 hover:text-white group">
                <i class="ri-folder-2-line mr-3 text-xl group-hover:text-red-300 transition-colors"></i>
                <span>Repositorio</span>
            </a>
            <a href="{{ route('admin.messages.index') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-600 rounded-xl transition-all duration-300 hover:text-white group">
                <i class="ri-mail-line mr-3 text-xl group-hover:text-cyan-300 transition-colors"></i>
                <span>Mensajes</span>
            </a>
            <a href="{{ route('admin.zone-dignitaries.index') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-600 rounded-xl transition-all duration-300 hover:text-white group">
                <i class="ri-crown-line mr-3 text-xl group-hover:text-amber-300 transition-colors"></i>
                <span>Dignatarios</span>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="flex items-center px-4 py-3 text-indigo-100 hover:bg-indigo-600 rounded-xl transition-all duration-300 hover:text-white group">
                <i class="ri-settings-2-line mr-3 text-xl group-hover:text-gray-300 transition-colors"></i>
                <span>Configuración</span>
            </a>
        </nav>
    </aside>

    <!-- Contenido Principal -->
    <div class="flex-grow flex flex-col bg-white shadow-inner">
        <!-- Encabezado de sección -->
        <div class="p-5 border-b border-gray-100 bg-gradient-to-r from-white to-indigo-50 sticky top-0 bg-white z-10 shadow-sm">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-indigo-800 flex items-center gap-2">
                        <i class="ri-building-2-line"></i> Gestión de Logias
                    </h1>
                    <p class="text-sm text-gray-600 mt-1">Administra las logias y sus detalles.</p>
                </div>
            </div>
            <div class="relative mt-4">
                <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400 text-lg"></i>
                <input type="search" name="search" placeholder="Buscar logias..." class="w-full bg-gray-50 border-2 border-gray-200 rounded-xl py-3 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-indigo-300 focus:border-indigo-40 transition-all shadow-sm focus:shadow-md" />
            </div>
        <!-- Lista de elementos -->
        <div class="overflow-y-auto flex-grow p-5">
            <livewire:admin.lodges.list-lodges />
        </div>
    </div>
</div>
@endsection