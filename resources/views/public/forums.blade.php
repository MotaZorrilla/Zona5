@extends('layouts.public')

@section('title', 'Foros - Gran Zona 5')

@section('content')
<div class="bg-gray-50">

    <!-- Hero Section -->
    <div class="relative bg-primary-600">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="https://picsum.photos/seed/forums-hero/1920/1080" alt="Foro de la Gran Zona 5">
            <div class="absolute inset-0 bg-primary-600 mix-blend-multiply" aria-hidden="true"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl font-serif">Foros de Debate</h1>
            <p class="mt-6 text-xl text-primary-100 max-w-3xl mx-auto">Un espacio para el diálogo constructivo, el intercambio de ideas y el fortalecimiento de la fraternidad.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8">

            <!-- Forum Content -->
            <div class="lg:col-span-8 xl:col-span-9">

                <!-- Search and Actions -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-8 border-b border-gray-200" data-scroll-reveal>
                    <div class="relative flex-1">
                        <input type="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-primary-500 focus:border-primary-500 sm:text-sm" placeholder="Buscar un tema...">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-search-line text-gray-400"></i>
                        </div>
                    </div>
                    <div class="mt-4 sm:mt-0 sm:ml-4">
                        @guest
                            <p class="text-sm text-gray-600">Para iniciar un nuevo tema, por favor <a href="{{ route('login') }}" class="underline font-semibold text-primary-600 hover:text-primary-500" wire:navigate>inicia sesión</a> o <a href="{{ route('register') }}" class="underline font-semibold text-primary-600 hover:text-primary-500" wire:navigate>regístrate</a>.</p>
                        @endguest
                        @auth
                            <button type="button" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 cta-button">
                                <i class="ri-add-circle-line -ml-1 mr-2"></i>
                                Iniciar un Nuevo Tema
                            </button>
                        @endauth
                    </div>
                </div>

                <!-- Breadcrumbs -->
                <nav class="flex py-5" aria-label="Breadcrumb">
                    <ol role="list" class="flex items-center space-x-4">
                        <li>
                            <div>
                                <a href="#" class="text-gray-400 hover:text-gray-500">
                                    <i class="ri-home-4-fill flex-shrink-0 h-5 w-5"></i>
                                    <span class="sr-only">Foros</span>
                                </a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="ri-arrow-right-s-line flex-shrink-0 h-5 w-5 text-gray-400"></i>
                                <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">Categorías</a>
                            </div>
                        </li>
                    </ol>
                </nav>

                <!-- Topics List -->
                <div class="bg-white shadow overflow-hidden sm:rounded-md" data-scroll-reveal>
                    <ul role="list" class="divide-y divide-gray-200">
                        <!-- Pinned Topic Example -->
                        <li class="hover:bg-gray-50 transition-colors duration-200">
                            <a href="#" class="block">
                                <div class="px-4 py-4 sm:px-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center">
                                            <i class="ri-pushpin-2-fill mr-2 text-yellow-500"></i>
                                            <p class="text-sm font-medium text-primary-600 truncate">
                                                Normas y Anuncios del Foro
                                            </p>
                                        </div>
                                        <div class="mt-2 sm:hidden text-sm text-gray-500">
                                            <p class="flex items-center">
                                                <i class="ri-user-3-line mr-1.5 h-5 w-5 text-gray-400"></i>
                                                Admin
                                            </p>
                                            <p class="mt-1 flex items-center">
                                                <i class="ri-calendar-line mr-1.5 h-5 w-5 text-gray-400"></i>
                                                Última actividad <time datetime="2025-09-05">hace 2 días</time>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="hidden sm:flex flex-col items-end sm:ml-4">
                                        <div class="flex space-x-2">
                                            <p class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">2 Respuestas</p>
                                            <p class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">1.2k Vistas</p>
                                        </div>
                                        <div class="mt-1 flex text-sm text-gray-500">
                                            <p class="flex items-center">
                                                <i class="ri-user-3-line mr-1.5 h-5 w-5 text-gray-400"></i>
                                                Admin
                                            </p>
                                            <p class="ml-3 flex items-center">
                                                <i class="ri-calendar-line mr-1.5 h-5 w-5 text-gray-400"></i>
                                                <time datetime="2025-09-05">hace 2 días</time>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <!-- Regular Topic Example 1 -->
                        <li class="hover:bg-gray-50 transition-colors duration-200">
                            <a href="#" class="block">
                                <div class="px-4 py-4 sm:px-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">Reflexiones sobre el Simbolismo del Primer Grado</p>
                                        <div class="mt-2 sm:hidden text-sm text-gray-500">
                                            <p class="flex items-center">
                                                <i class="ri-user-3-line mr-1.5 h-5 w-5 text-gray-400"></i>
                                                V.`.`H.`.` Juan Pérez
                                            </p>
                                            <p class="mt-1 flex items-center">
                                                <i class="ri-calendar-line mr-1.5 h-5 w-5 text-gray-400"></i>
                                                Última actividad <time datetime="2025-09-07">hace 3 horas</time>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="hidden sm:flex flex-col items-end sm:ml-4">
                                        <div class="flex space-x-2">
                                            <p class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">15 Respuestas</p>
                                            <p class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">3.4k Vistas</p>
                                        </div>
                                        <div class="mt-1 flex text-sm text-gray-500">
                                            <p class="flex items-center">
                                                <i class="ri-user-3-line mr-1.5 h-5 w-5 text-gray-400"></i>
                                                V.`.`H.`.` Juan Pérez
                                            </p>
                                            <p class="ml-3 flex items-center">
                                                <i class="ri-calendar-line mr-1.5 h-5 w-5 text-gray-400"></i>
                                                <time datetime="2025-09-07">hace 3 horas</time>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>

                        <!-- Regular Topic Example 2 -->
                        <li class="hover:bg-gray-50 transition-colors duration-200">
                            <a href="#" class="block">
                                <div class="px-4 py-4 sm:px-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">Propuesta de Caridad para el Solsticio de Invierno</p>
                                        <div class="mt-2 sm:hidden text-sm text-gray-500">
                                            <p class="flex items-center">
                                                <i class="ri-user-3-line mr-1.5 h-5 w-5 text-gray-400"></i>
                                                Q.`.`H.`.` Carlos Gómez
                                            </p>
                                            <p class="mt-1 flex items-center">
                                                <i class="ri-calendar-line mr-1.5 h-5 w-5 text-gray-400"></i>
                                                Última actividad <time datetime="2025-09-06">ayer</time>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="hidden sm:flex flex-col items-end sm:ml-4">
                                        <div class="flex space-x-2">
                                            <p class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">8 Respuestas</p>
                                            <p class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">980 Vistas</p>
                                        </div>
                                        <div class="mt-1 flex text-sm text-gray-500">
                                            <p class="flex items-center">
                                                <i class="ri-user-3-line mr-1.5 h-5 w-5 text-gray-400"></i>
                                                Q.`.`H.`.` Carlos Gómez
                                            </p>
                                            <p class="ml-3 flex items-center">
                                                <i class="ri-calendar-line mr-1.5 h-5 w-5 text-gray-400"></i>
                                                <time datetime="2025-09-06">ayer</time>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        
                        <!-- More topics... -->
                    </ul>
                </div>

                <!-- Pagination -->
                <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 mt-4 rounded-md" aria-label="Pagination" data-scroll-reveal>
                    <div class="hidden sm:block">
                        <p class="text-sm text-gray-700">
                            Mostrando
                            <span class="font-medium">1</span>
                            a
                            <span class="font-medium">10</span>
                            de
                            <span class="font-medium">97</span>
                            resultados
                        </p>
                    </div>
                    <div class="flex-1 flex justify-between sm:justify-end">
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Anterior
                        </a>
                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Siguiente
                        </a>
                    </div>
                </nav>

            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 xl:col-span-3 mt-8 lg:mt-0">
                <div class="space-y-6">
                    <!-- Categories -->
                    <div class="bg-white p-6 shadow rounded-lg" data-scroll-reveal>
                        <h3 class="text-lg font-medium text-gray-900 font-serif">Categorías</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="flex justify-between items-center text-gray-600 hover:text-primary-600 font-medium"><span>Discusión General</span> <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">42</span></a></li>
                            <li><a href="#" class="flex justify-between items-center text-primary-600 hover:text-primary-800 font-bold"><span>Simbolismo y Filosofía</span> <span class="bg-primary-100 text-primary-800 text-xs font-medium px-2.5 py-0.5 rounded-full">15</span></a></li>
                            <li><a href="#" class="flex justify-between items-center text-gray-600 hover:text-primary-600 font-medium"><span>Historia Masónica</span> <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">23</span></a></li>
                            <li><a href="#" class="flex justify-between items-center text-gray-600 hover:text-primary-600 font-medium"><span>Administración y Logias</span> <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">8</span></a></li>
                            <li><a href="#" class="flex justify-between items-center text-gray-600 hover:text-primary-600 font-medium"><span>Eventos y Caridad</span> <span class="bg-gray-200 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">9</span></a></li>
                        </ul>
                    </div>

                    <!-- Recent Activity -->
                    <div class="bg-white p-6 shadow rounded-lg" data-scroll-reveal>
                        <h3 class="text-lg font-medium text-gray-900 font-serif">Actividad Reciente</h3>
                        <ul class="mt-4 space-y-4">
                            <li class="flex items-start">
                                <img class="h-10 w-10 rounded-full flex-shrink-0" src="https://i.pravatar.cc/40?u=1" alt="">
                                <div class="ml-3 min-w-0">
                                    <p class="text-sm text-gray-700 break-words">Q.`.`H.`.` Carlos comentó en <a href="#" class="font-medium text-primary-600 hover:underline">Propuesta de Caridad...</a></p>
                                    <p class="text-xs text-gray-500">hace 5 minutos</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <img class="h-10 w-10 rounded-full flex-shrink-0" src="https://i.pravatar.cc/40?u=2" alt="">
                                <div class="ml-3 min-w-0">
                                    <p class="text-sm text-gray-700 break-words">V.`.`H.`.` Juan creó un nuevo tema: <a href="#" class="font-medium text-primary-600 hover:underline">La influencia de la geometría...</a></p>
                                    <p class="text-xs text-gray-500">hace 1 hora</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <img class="h-10 w-10 rounded-full flex-shrink-0" src="https://i.pravatar.cc/40?u=3" alt="">
                                <div class="ml-3 min-w-0">
                                    <p class="text-sm text-gray-700 break-words">Admin comentó en <a href="#" class="font-medium text-primary-600 hover:underline">Normas y Anuncios...</a></p>
                                    <p class="text-xs text-gray-500">hace 2 horas</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
