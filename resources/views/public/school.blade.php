@extends('layouts.public')

@section('title', 'Escuela Virtual - Gran Zona 5')

@section('content')

    <!-- Hero Section -->
    <div class="relative bg-primary-800">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2940&q=80" alt="Escuela Virtual de la Gran Zona 5">
            <div class="absolute inset-0 bg-primary-800 mix-blend-multiply" aria-hidden="true"></div>
        </div>
        <div class="relative max-w-4xl mx-auto text-center py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl font-serif">Escuela Virtual de la Zona 5</h1>
            <p class="mt-6 text-xl text-primary-100">Fomentando la luz del conocimiento a través de la formación continua, síncrona y asíncrona.</p>
            @guest
                <p class="mt-8 text-white text-lg">Para acceder a los cursos, por favor <a href="{{ route('login') }}" class="underline font-semibold hover:text-primary-200" wire:navigate>inicia sesión</a> o <a href="{{ route('register') }}" class="underline font-semibold hover:text-primary-200" wire:navigate>regístrate</a>.</p>
            @endguest
            @auth
                <a href="#" target="_blank" class="mt-8 w-full inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-md text-primary-600 bg-white hover:bg-primary-50 sm:w-auto cta-button">
                    Acceder al Campus Virtual <i class="ri-external-link-line ml-2"></i>
                </a>
            @endauth
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-16 sm:py-24 lg:py-32">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Upcoming Live Classes -->
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl font-serif">Próximas Clases en Vivo</h2>
                <p class="mt-4 text-lg text-gray-500">Participa en nuestras sesiones interactivas y comparte en tiempo real con instructores y hermanos.</p>
            </div>
            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <x-card title="La Retórica en el Arte Real" subtitle="Un análisis profundo sobre el uso de la palabra y la persuasión en la vida masónica." type="EN VIVO PRONTO" link="#">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-500 text-white rounded-md p-2">
                                <i class="ri-live-fill"></i>
                            </div>
                            <span class="ml-3 text-sm font-medium text-red-600">EN VIVO PRONTO</span>
                        </div>
                        <span class="text-sm text-gray-500">20 de Sep, 2025</span>
                    </div>
                    <div class="mt-4 flex items-center">
                        <img class="h-10 w-10 rounded-full" src="https://i.pravatar.cc/40?u=4" alt="">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">V.`.`H.`.` Ricardo Salas</p>
                            <p class="text-sm text-gray-500">Orador de la G.`.`L.`.`R.`.`V.`.</p>
                        </div>
                    </div>
                    @guest
                        <a href="{{ route('login') }}" class="mt-6 block w-full text-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-primary-600 shadow-sm ring-1 ring-inset ring-primary-600 hover:bg-primary-50">Inicia Sesión para Inscribirte</a>
                    @endguest
                    @auth
                        <a href="#" class="mt-6 block w-full text-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-primary-600 shadow-sm ring-1 ring-inset ring-primary-600 hover:bg-primary-50">Inscribirse Ahora</a>
                    @endauth
                </x-card>
                <x-card title="Manejo de Tesorería en Logia" subtitle="Principios de contabilidad y administración para una tesorería eficiente y transparente." type="EN VIVO PRONTO" link="#">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-500 text-white rounded-md p-2">
                                <i class="ri-live-fill"></i>
                            </div>
                            <span class="ml-3 text-sm font-medium text-red-600">EN VIVO PRONTO</span>
                        </div>
                        <span class="text-sm text-gray-500">27 de Sep, 2025</span>
                    </div>
                    <div class="mt-4 flex items-center">
                        <img class="h-10 w-10 rounded-full" src="https://i.pravatar.cc/40?u=5" alt="">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Q.`.`H.`.` Alberto Ríos</p>
                            <p class="text-sm text-gray-500">Gran Tesorero Adjunto</p>
                        </div>
                    </div>
                    @guest
                        <a href="{{ route('login') }}" class="mt-6 block w-full text-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-primary-600 shadow-sm ring-1 ring-inset ring-primary-600 hover:bg-primary-50">Inicia Sesión para Inscribirte</a>
                    @endguest
                    @auth
                        <a href="#" class="mt-6 block w-full text-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-primary-600 shadow-sm ring-1 ring-inset ring-primary-600 hover:bg-primary-50">Inscribirse Ahora</a>
                    @endauth
                </x-card>
                <x-card title="Taller de Liturgia y Ritual" subtitle="Un espacio para perfeccionar la ejecución del ritual y comprender su profundo significado." type="PRÓXIMAMENTE" link="#">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gray-400 text-white rounded-md p-2">
                                <i class="ri-calendar-event-line"></i>
                            </div>
                            <span class="ml-3 text-sm font-medium text-gray-600">PRÓXIMAMENTE</span>
                        </div>
                        <span class="text-sm text-gray-500">Octubre 2025</span>
                    </div>
                    <div class="mt-4 flex items-center">
                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center"><i class="ri-user-line text-gray-500"></i></div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">Por Anunciar</p>
                            <p class="text-sm text-gray-500">Comisión de Liturgia</p>
                        </div>
                    </div>
                    @guest
                        <a href="{{ route('login') }}" class="mt-6 block w-full text-center rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-500 shadow-sm ring-1 ring-inset ring-gray-300 cursor-not-allowed">Inicia Sesión para Ver Detalles</a>
                    @endguest
                    @auth
                        <a href="#" class="mt-6 block w-full text-center rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-500 shadow-sm ring-1 ring-inset ring-gray-300 cursor-not-allowed">Registro Cerrado</a>
                    @endauth
                </x-card>
            </div>

            <!-- Asynchronous Courses -->
            <div class="mt-24 text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl font-serif">Catálogo de Cursos Asíncronos</h2>
                <p class="mt-4 text-lg text-gray-500">Aprende a tu propio ritmo con nuestra biblioteca de cursos disponibles 24/7.</p>
            </div>
            <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <x-card image="https://images.unsplash.com/photo-1588196749597-9ff075ee6b5b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80" title="Historia y Filosofía de la Masonería" subtitle="Un recorrido desde los antiguos constructores hasta la masonería especulativa moderna." type="Primer Grado" link="#">
                    @guest
                        <a href="{{ route('login') }}" class="mt-6 block w-full text-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Inicia Sesión para Ver Curso</a>
                    @endguest
                    @auth
                        <a href="#" class="mt-6 block w-full text-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Ver Curso</a>
                    @endauth
                </x-card>
                <x-card image="https://images.unsplash.com/photo-1516321497487-e288fb19713f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80" title="Las 7 Artes Liberales y el Compañero" subtitle="Explora la gramática, retórica, lógica, aritmética, geometría, música y astronomía." type="Segundo Grado" link="#">
                    @guest
                        <a href="{{ route('login') }}" class="mt-6 block w-full text-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Inicia Sesión para Ver Curso</a>
                    @endguest
                    @auth
                        <a href="#" class="mt-6 block w-full text-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Ver Curso</a>
                    @endauth
                </x-card>
                <x-card image="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2832&q=80" title="Liderazgo y Dirección de Logia" subtitle="Herramientas prácticas para Venerables Maestros y oficiales en la conducción de una logia." type="Tercer Grado" link="#">
                    @guest
                        <a href="{{ route('login') }}" class="mt-6 block w-full text-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Inicia Sesión para Ver Curso</a>
                    @endguest
                    @auth
                        <a href="#" class="mt-6 block w-full text-center rounded-md bg-primary-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary-600">Ver Curso</a>
                    @endauth
                </x-card>
            </div>
