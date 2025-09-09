@extends('layouts.public')

@section('title', 'Quiénes Somos - Gran Zona 5')

@section('content')
    {{-- Header con Imagen de Fondo --}}
    <div class="relative bg-primary-800">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="https://picsum.photos/seed/about-us-hero/1920/1080" alt="Equipo trabajando">
            <div class="absolute inset-0 bg-primary-800 mix-blend-multiply" aria-hidden="true"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl font-serif">Quiénes Somos</h1>
            <p class="mt-6 text-xl text-primary-100 max-w-3xl mx-auto">Un recorrido por la historia y el propósito de la Masonería en la Gran Zona 5 del Estado Bolívar.</p>
        </div>
    </div>

    {{-- Contenido Principal --}}
    <div class="bg-white" x-data="{ activeModal: null }">
        <!-- Historia Section -->
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8" data-scroll-reveal>
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 font-serif">Nuestra Historia</h2>
                <p class="mt-4 text-lg text-gray-500">La Masonería en la región de Guayana tiene raíces profundas, entrelazadas con el desarrollo social, cultural y político del Estado Bolívar. Desde la fundación de las primeras logias, los hermanos masones han sido pilares en la construcción de una sociedad más justa, educada y fraterna.</p>
            </div>
            <div class="mt-12 text-center">
                <blockquote class="inline-block p-8 bg-gray-50 rounded-xl">
                    <p class="text-xl font-medium text-gray-700">"Buscamos hacer de hombres buenos, mejores hombres. Hombres comprometidos con su entorno, su familia y su país."</p>
                </blockquote>
            </div>
        </div>

        <!-- Misión y Visión Section -->
        <div class="bg-gray-50" data-scroll-reveal>
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                <div>
                    <h3 class="text-2xl font-extrabold text-gray-900 font-serif mb-4">Misión</h3>
                    <p class="text-gray-600 text-lg">Preservar y transmitir los principios universales de la Francmasonería: Libertad, Igualdad y Fraternidad. Fomentamos el estudio filosófico, el desarrollo moral y la práctica de la filantropía entre nuestros miembros.</p>
                </div>
                <div class="border-t-4 border-primary-500 pt-6">
                    <h3 class="text-2xl font-extrabold text-gray-900 font-serif mb-4">Visión</h3>
                    <p class="text-gray-600 text-lg">Aspiramos a ser una institución relevante y respetada, reconocida por su contribución positiva al progreso de la sociedad guayanesa, formando líderes éticos y ciudadanos ejemplares que trabajen por el bienestar común.</p>
                </div>
            </div>
        </div>

        <!-- Pilares Section -->
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8" data-scroll-reveal>
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 font-serif">Nuestros Pilares</h2>
                <p class="mt-4 text-lg text-gray-500">La Zona 5 se apoya en los cuatro pilares que promueven la Gran Logia de la República de Venezuela, guiando nuestro trabajo y fortaleciendo nuestra Augusta Institución.</p>
            </div>
            <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mx-auto mb-6">
                        <i class="ri-group-line text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900">Fraternidad</h4>
                    <p class="mt-2 text-gray-500">El lazo indisoluble que nos une como hermanos, fomentando el apoyo mutuo, la armonía y la comprensión más allá de cualquier diferencia.</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mx-auto mb-6">
                        <i class="ri-book-open-line text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900">Docencia</h4>
                    <p class="mt-2 text-gray-500">La búsqueda incesante de la verdad y el conocimiento a través del estudio, la instrucción y el intercambio de ideas para el perfeccionamiento individual.</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mx-auto mb-6">
                        <i class="ri-hand-heart-line text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900">Filantropía</h4>
                    <p class="mt-2 text-gray-500">El amor a la humanidad manifestado en obras de caridad y beneficencia, trabajando activamente por el bienestar y el progreso de nuestra comunidad.</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mx-auto mb-6">
                        <i class="ri-shield-star-line text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900">Sentido de Pertenencia</h4>
                    <p class="mt-2 text-gray-500">El orgullo y compromiso que sentimos hacia nuestra Orden, Logia y Hermanos, fortaleciendo nuestra identidad y cohesión como institución.</p>
                </div>
            </div>
        </div>

        <!-- Junta Directiva Section -->
        <div class="bg-gray-50" data-scroll-reveal>
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 font-serif">Nuestra Junta Directiva</h2>
                    <p class="mt-4 text-lg text-gray-500">El equipo que lidera y coordina los trabajos de la Gran Zona 5.</p>
                </div>
                @php
                    $boardMembers = [
                        [
                            'name' => 'Luis Bartolo',
                            'role' => 'Gran Maestro de Zona',
                            'image' => 'https://picsum.photos/seed/board1/500/500',
                            'bio' => 'Líder con más de 20 años de experiencia en la masonería, enfocado en el crecimiento y la fraternidad de la zona. Su gestión se centra en la modernización y la apertura de la institución a la sociedad.'
                        ],
                        [
                            'name' => 'Carlos Larreal',
                            'role' => 'Diputado Gran Maestro',
                            'image' => 'https://picsum.photos/seed/board2/500/500',
                            'bio' => 'Mano derecha del Gran Maestro, encargado de la supervisión de las logias y el cumplimiento de los reglamentos. Apasionado por la historia y la docencia masónica.'
                        ],
                        [
                            'name' => 'Pedro González',
                            'role' => 'Gran Secretario',
                            'image' => 'https://picsum.photos/seed/board3/500/500',
                            'bio' => 'Responsable de la comunicación oficial, la documentación y las actas de la Gran Zona. Su labor es fundamental para la organización y el registro histórico de nuestras actividades.'
                        ],
                        [
                            'name' => 'José Fernández',
                            'role' => 'Gran Tesorero',
                            'image' => 'https://picsum.photos/seed/board4/500/500',
                            'bio' => 'Guardián de las finanzas y los recursos de la Gran Zona. Administrador experimentado que asegura la sostenibilidad y el buen uso de los fondos para las obras de beneficencia y el mantenimiento.'
                        ],
                    ];
                @endphp
                <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($boardMembers as $member)
                        <x-card-member :image="$member['image']" :name="$member['name']" :role="$member['role']" :slug="Str::slug($member['name'])" />

                        <x-modal :name="Str::slug($member['name'])" maxWidth="lg">
                            <div class="p-6">
                                <div class="flex flex-col sm:flex-row items-center">
                                    <img class="h-32 w-32 rounded-full object-cover shadow-lg flex-shrink-0" src="{{ $member['image'] }}" alt="">
                                    <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left">
                                        <h3 class="text-2xl font-bold text-gray-900">{{ $member['name'] }}</h3>
                                        <p class="text-lg text-primary-600 font-semibold">{{ $member['role'] }}</p>
                                    </div>
                                </div>
                                <p class="mt-6 text-gray-600 text-justify">{{ $member['bio'] }}</p>
                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close-modal', '{{ Str::slug($member['name']) }}')">
                                        Cerrar
                                    </x-secondary-button>
                                </div>
                            </div>
                        </x-modal>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
