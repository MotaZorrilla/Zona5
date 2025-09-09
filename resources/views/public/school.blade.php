@extends('layouts.public')

@section('title', 'Escuela Virtual - Gran Zona 5')

@section('content')
<x-under-construction-overlay>
    <div>
        <!-- Hero Section -->
        <div class="relative bg-primary-800">
            <div class="absolute inset-0">
                <img class="w-full h-full object-cover" src="https://picsum.photos/seed/school-hero/1920/1080" alt="Escuela Virtual de la Gran Zona 5">
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
                <div class="text-center" data-scroll-reveal>
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl font-serif">Próximas Clases en Vivo</h2>
                    <p class="mt-4 text-lg text-gray-500">Participa en nuestras sesiones interactivas y comparte en tiempo real con instructores y hermanos.</p>
                </div>
                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <x-card-event 
                        image="https://picsum.photos/seed/event-rhetoric/800/600"
                        title="La Retórica en el Arte Real" 
                        subtitle="Un análisis profundo sobre el uso de la palabra y la persuasión en la vida masónica." 
                        date="2025-09-20" 
                        time="19:00"
                        instructorName="V.`.`H.`.` Ricardo Salas"
                        instructorRole="Orador de la G.`.`L.`.`R.`.`V.`."
                        instructorImage="https://i.pravatar.cc/40?u=4"
                        status="upcoming"
                        link="#"
                    />
                    <x-card-event 
                        image="https://picsum.photos/seed/event-treasury/800/600"
                        title="Manejo de Tesorería en Logia" 
                        subtitle="Principios de contabilidad y administración para una tesorería eficiente y transparente." 
                        date="2025-09-27" 
                        time="19:30"
                        instructorName="Q.`.`H.`.` Alberto Ríos"
                        instructorRole="Gran Tesorero Adjunto"
                        instructorImage="https://i.pravatar.cc/40?u=5"
                        status="upcoming"
                        link="#"
                    />
                    <x-card-event 
                        image="https://picsum.photos/seed/event-liturgy/800/600"
                        title="Taller de Liturgia y Ritual" 
                        subtitle="Un espacio para perfeccionar la ejecución del ritual y comprender su profundo significado." 
                        date="2025-10-15" 
                        status="closed"
                        instructorName="Por Anunciar"
                        instructorRole="Comisión de Liturgia"
                        link="#"
                    />
                </div>

                <!-- Asynchronous Courses -->
                <div class="mt-24 text-center" data-scroll-reveal>
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl font-serif">Catálogo de Cursos Asíncronos</h2>
                    <p class="mt-4 text-lg text-gray-500">Aprende a tu propio ritmo con nuestra biblioteca de cursos disponibles 24/7.</p>
                </div>
                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    <x-card-course 
                        image="https://picsum.photos/seed/school-card1/800/600" 
                        title="Historia y Filosofía de la Masonería" 
                        subtitle="Un recorrido desde los antiguos constructores hasta la masonería especulativa moderna." 
                        grade="Primer Grado" 
                        link="#"
                    />
                    <x-card-course 
                        image="https://picsum.photos/seed/school-card2/800/600" 
                        title="Las 7 Artes Liberales y el Compañero" 
                        subtitle="Explora la gramática, retórica, lógica, aritmética, geometría, música y astronomía." 
                        grade="Segundo Grado" 
                        link="#"
                    />
                    <x-card-course 
                        image="https://picsum.photos/seed/school-card3/800/600" 
                        title="Liderazgo y Dirección de Logia" 
                        subtitle="Herramientas prácticas para Venerables Maestros y oficiales en la conducción de una logia." 
                        grade="Tercer Grado" 
                        link="#"
                    />
                </div>
            </div>
        </div>
    </div>
</x-under-construction-overlay>
@endsection
