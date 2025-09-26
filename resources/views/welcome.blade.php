@extends('layouts.public')

@section('title', 'Bienvenido a la Gran Zona 5')

@section('content')
    <!-- Header & Hero Section -->
    <div class="relative bg-gradient-to-r from-primary-800 to-blue-900 overflow-hidden">
        <div class="absolute inset-0">
            <img class="h-full w-full object-cover opacity-10" src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="Biblioteca">
        </div>
        <div class="relative max-w-7xl mx-auto pt-48 pb-32 px-4 sm:px-6 lg:px-8">
            <!-- Hero Content -->
            <div class="text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-7xl font-serif">
                    <span class="block">Bienvenido al Portal de la</span>
                    <span class="block text-yellow-300 mt-2">Gran Zona 5</span>
                </h1>
                <p class="mt-6 max-w-3xl mx-auto text-xl text-blue-100 sm:text-2xl md:mt-8">
                    Espacio público con información sobre nuestra jurisdicción, logias y actividades
                </p>
                <div class="mt-10 max-w-2xl mx-auto sm:flex sm:justify-center md:mt-12">
                    <div class="rounded-md shadow">
                        <x-button href="{{ route('public.about-us') }}" size="lg" class="px-8 py-4 text-lg">
                            Conoce Nuestra Historia
                        </x-button>
                    </div>
                    <div class="mt-3 sm:mt-0 sm:ml-3">
                        <x-button href="{{ route('login') }}" variant="secondary" size="lg" class="px-8 py-4 text-lg">
                            Acceso Miembros
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white to-transparent"></div>
    </div>

    <!-- Welcome Section -->
    <div class="py-16 bg-white" data-scroll-reveal>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-3xl font-extrabold text-primary-600 font-serif">Bienvenido al Portal Público</h2>
                <p class="mt-4 max-w-3xl mx-auto text-xl text-gray-500">
                    En este espacio encontrará información sobre nuestra jurisdicción, nuestras logias y actividades relacionadas. 
                    Algunos recursos requieren registro e inicio de sesión para acceder a todos los beneficios.
                </p>
            </div>
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mx-auto">
                        <i class="ri-book-open-line text-3xl"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-gray-900 text-center">Nuestra Historia</h3>
                    <p class="mt-4 text-gray-600 text-center">
                        Descubre el camino recorrido por nuestra zona desde sus inicios hasta el presente
                    </p>
                    <div class="mt-6 text-center">
                        <x-button href="{{ route('public.about-us') }}" variant="primary" size="sm">
                            Leer Más
                        </x-button>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"> <!-- Green as requested -->
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-green-100 text-green-600 mx-auto"> <!-- Green as requested -->
                        <i class="ri-group-line text-3xl"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-gray-900 text-center">Nuestras Logias</h3>
                    <p class="mt-4 text-gray-600 text-center">
                        Conoce las más de 30 logias que conforman nuestra jurisdicción en el Estado Bolívar
                    </p>
                    <div class="mt-6 text-center">
                        <x-button href="{{ route('public.lodges') }}" variant="primary" size="sm">
                            Ver Logias
                        </x-button>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"> <!-- Yellow as requested -->
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 text-yellow-600 mx-auto"> <!-- Yellow as requested -->
                        <i class="ri-calendar-event-line text-3xl"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-gray-900 text-center">Eventos y Noticias</h3>
                    <p class="mt-4 text-gray-600 text-center">
                        Mantente al día con las actividades, eventos y comunicados de nuestra zona
                    </p>
                    <div class="mt-6 text-center">
                        <x-button href="{{ route('public.news') }}" variant="primary" size="sm">
                            Ver Noticias
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured News Section -->
    <div class="bg-gradient-to-br from-gray-50 to-blue-50 py-16" data-scroll-reveal>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-primary-600 font-serif">Últimas Noticias y Eventos</h2>
                <p class="mt-4 text-lg text-gray-500">La actualidad de nuestra zona, al alcance de todos</p>
            </div>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($latestNews as $news)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <x-card-image 
                        image="{{ $news->image_path ? asset('storage/' . $news->image_path) : 'https://picsum.photos/seed/news-' . $news->id . '/800/600' }}" 
                        title="{{ $news->title }}" 
                        subtitle="{{ Str::limit($news->excerpt, 100) }}" 
                        type="{{ $news->status === 'published' ? 'Noticia' : ucfirst($news->status) }}" 
                        link="{{ route('public.news') }}"
                        typeBgColor="bg-green-100"
                        typeTextColor="text-green-800"
                        borderColor="border-green-500"
                    >
                        <div class="mt-6 flex items-center">
                            <div class="text-sm text-gray-500">
                                @if($news->published_at)
                                    {{ \Carbon\Carbon::parse($news->published_at)->format('d M, Y') }}
                                @else
                                    Fecha no disponible
                                @endif
                            </div>
                        </div>
                    </x-card-image>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-500">No hay noticias publicadas en este momento.</p>
                </div>
                @endforelse
            </div>
            <div class="mt-12 text-center">
                <x-button href="{{ route('public.news') }}" variant="primary">Ver Todas las Noticias</x-button>
            </div>
        </div>
    </div>

    <!-- Featured Lodges Section -->
    <div class="bg-white py-16" data-scroll-reveal>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-primary-600 font-serif">Nuestras Logias</h2>
                <p class="mt-4 text-lg text-gray-500">Descubre las logias que conforman nuestra zona</p>
            </div>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredLodges as $lodge)
                <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <x-card-image 
                        image="https://picsum.photos/seed/{{ $lodge->slug }}/800/600" 
                        title="{{ $lodge->name }} N° {{ $lodge->number }}" 
                        subtitle="Oriente de {{ $lodge->orient }}" 
                        link="{{ route('public.lodges.show', $lodge->slug) }}" 
                    />
                </div>
                @endforeach
            </div>
            <div class="mt-12 text-center">
                <x-button href="{{ route('public.lodges') }}" variant="primary">Ver Todas las Logias</x-button>
            </div>
        </div>
    </div>

    <!-- Zone Dignitaries Section -->
    <div class="bg-gradient-to-br from-primary-50 to-blue-50 py-16" data-scroll-reveal>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-primary-600 font-serif">Autoridades de la Gran Zona 5</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                    Conoce a los dignatarios que lideran nuestra jurisdicción
                </p>
            </div>
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($zoneDignitaries as $index => $dignitary)
                @php
                    // Definir colores suaves de la paleta para cada posición
                    $cardColors = [
                        'from-blue-50 to-indigo-50',    // Presidente
                        'from-green-50 to-teal-50',     // Vicepresidente
                        'from-amber-50 to-orange-50'    // Secretario
                    ];
                    $headerColors = [
                        'bg-gradient-to-r from-blue-500 to-blue-600',    // Presidente
                        'bg-gradient-to-r from-green-500 to-green-600',  // Vicepresidente
                        'bg-gradient-to-r from-amber-500 to-amber-600'   // Secretario
                    ];
                    $colorIndex = $index % 3;
                    $cardColor = $cardColors[$colorIndex];
                    $headerColor = $headerColors[$colorIndex];
                @endphp
                <div class="bg-gradient-to-br {{ $cardColor }} rounded-xl shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-105">
                    <div class="{{ $headerColor }} px-6 py-4">
                        <h3 class="text-xl font-bold text-white text-center">{{ $dignitary->role }}</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-center">
                            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-24 h-24 flex items-center justify-center text-gray-400">
                                <i class="ri-user-line text-4xl"></i>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <h4 class="text-lg font-bold text-gray-900">{{ $dignitary->name }}</h4>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-12 text-center">
                <x-button href="{{ route('public.about-us') }}#junta-directiva" variant="secondary">
                    Conoce a toda la Junta Directiva
                </x-button>
            </div>
        </div>
    </div>

    <!-- Useful Links Section -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-primary-600 font-serif">Enlaces Útiles</h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                    Accede rápidamente a información importante sobre nuestra organización
                </p>
            </div>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mx-auto">
                        <i class="ri-map-2-line text-2xl"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-gray-900 text-center">Mapa del Sitio</h3>
                    <p class="mt-4 text-gray-600 text-center">
                        Navega fácilmente por todas las secciones de nuestro portal
                    </p>
                    <div class="mt-6 text-center">
                        <x-button href="{{ route('public.sitemap') }}" variant="primary" size="sm">
                            Explorar <i class="ri-arrow-right-line ml-1"></i>
                        </x-button>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-green-100 text-green-600 mx-auto">
                        <i class="ri-question-line text-2xl"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-gray-900 text-center">Preguntas Frecuentes</h3>
                    <p class="mt-4 text-gray-600 text-center">
                        Encuentra respuestas a las dudas más comunes sobre nuestra organización
                    </p>
                    <div class="mt-6 text-center">
                        <x-button href="{{ route('public.faq') }}" variant="primary" size="sm">
                            Ver preguntas <i class="ri-arrow-right-line ml-1"></i>
                        </x-button>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-amber-100 text-amber-600 mx-auto">
                        <i class="ri-lock-line text-2xl"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-gray-900 text-center">Política de Privacidad</h3>
                    <p class="mt-4 text-gray-600 text-center">
                        Conoce cómo protegemos y manejamos tu información personal
                    </p>
                    <div class="mt-6 text-center">
                        <x-button href="{{ route('privacy-policy') }}" variant="primary" size="sm">
                            Leer política <i class="ri-arrow-right-line ml-1"></i>
                        </x-button>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 text-purple-600 mx-auto">
                        <i class="ri-file-text-line text-2xl"></i>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-gray-900 text-center">Términos de Servicio</h3>
                    <p class="mt-4 text-gray-600 text-center">
                        Conoce las condiciones de uso de nuestro portal y servicios
                    </p>
                    <div class="mt-6 text-center">
                        <x-button href="{{ route('terms-of-service') }}" variant="primary" size="sm">
                            Ver términos <i class="ri-arrow-right-line ml-1"></i>
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-primary-700 to-blue-800" data-scroll-reveal>
        <div class="max-w-4xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl font-serif">
                <span class="block">¿Tienes alguna pregunta o comentario?</span>
                <span class="block mt-2 text-yellow-300">Estamos aquí para ayudarte</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-blue-100">
                Ponte en contacto con nosotros y te responderemos a la brevedad.
            </p>
            <x-button href="{{ route('public.contact') }}" variant="secondary" class="mt-8 px-8 py-4 text-lg">
                Contáctanos
            </x-button>
        </div>
    </div>
@endsection