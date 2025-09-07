@extends('layouts.public')

@section('title', 'Archivo Histórico')

@section('content')
    <x-public.hero 
        title="Archivo Histórico" 
        subtitle="Un viaje a través de los documentos que han marcado nuestra historia."
        imageUrl="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80"
    />

    <div class="bg-gray-50 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Search and Filters -->
            <div class="mt-10 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="relative w-full md:w-2/3">
                    <i class="ri-search-line absolute top-1/2 -translate-y-1/2 left-3 text-gray-400"></i>
                    <input type="text" class="w-full bg-white border border-gray-300 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-primary-400" placeholder="Buscar en el archivo...">
                </div>
                <div class="flex items-center gap-4">
                    <select class="bg-white border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-primary-400">
                        <option>Filtrar por Categoría</option>
                        <option>Historia</option>
                        <option>Ritual</option>
                        <option>Administración</option>
                    </select>
                </div>
            </div>
            <!-- Documents List -->
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <x-card image="https://images.unsplash.com/photo-1583321500443-79232e7b9125?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" title="Fundación de la Gran Logia de la República de Venezuela" subtitle="Un recorrido por los eventos y personajes que dieron origen a nuestra Gran Logia." type="Historia" link="#">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        <time datetime="2020-03-16" class="text-gray-500">16 Mar, 2020</time>
                    </div>
                </x-card>
                <!-- More posts... -->
            </div>
        </div>
    </div>

    <!-- Recent Documents List -->
    <div>
        <h3 class="text-xl font-bold text-gray-800 mb-4">Documentos Recientes</h3>
        @guest
            <p class="text-sm text-gray-600 mb-4">Para descargar documentos, por favor <a href="{{ route('login') }}" class="underline font-semibold text-primary-600 hover:text-primary-500" wire:navigate>inicia sesión</a> o <a href="{{ route('register') }}" class="underline font-semibold text-primary-600 hover:text-primary-500" wire:navigate>regístrate</a>.</p>
        @endguest
        <div class="space-y-4">
            <!-- Document Item 1 -->
            <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <i class="ri-file-pdf-2-line text-3xl text-red-500 mr-4"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Plancha de Arquitectura sobre el Simbolismo</p>
                        <p class="text-xs text-gray-500">Categoría: Historia y Filosofía | Grado: Maestro (3) | Subido por: Carlos Rodriguez</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-500">Hace 2h</span>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="text-gray-500 hover:text-gray-700"><i class="ri-more-2-fill"></i></button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-10 py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ver Detalles</a>
                            @guest
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Iniciar Sesión para Descargar</a>
                            @endguest
                            @auth
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Descargar</a>
                                <a href="#" class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100">Eliminar</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <!-- Document Item 2 -->
            <div class="bg-gray-50 p-4 rounded-lg flex items-center justify-between hover:shadow-md transition-shadow">
                <div class="flex items-center">
                    <i class="ri-file-word-2-line text-3xl text-blue-500 mr-4"></i>
                    <div>
                        <p class="font-semibold text-gray-800">Decreto N° 23-05</p>
                        <p class="text-xs text-gray-500">Categoría: Administración | Grado: Todos | Subido por: Héctor Mota</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-500">Ayer</span>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="text-gray-500 hover:text-gray-700"><i class="ri-more-2-fill"></i></button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl z-10 py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Ver Detalles</a>
                            @guest
                                <a href="{{ route('login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Iniciar Sesión para Descargar</a>
                            @endguest
                            @auth
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Descargar</a>
                                <a href="#" class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-100">Eliminar</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
