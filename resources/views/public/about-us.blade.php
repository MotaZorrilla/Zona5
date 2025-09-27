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
        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 py-16" data-scroll-reveal>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl font-extrabold text-primary-600 font-serif mb-8">Nuestra Historia</h2>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                        <div class="text-lg text-gray-700 leading-relaxed text-center">
                            <p class="mb-6" style="text-indent: 2rem;">
                                La Masonería en la región de Guayana tiene raíces profundas, entrelazadas con el desarrollo social, cultural y político del Estado Bolívar. Desde la fundación de las primeras logias, los hermanos masones han sido pilares en la construcción de una sociedad más justa, educada y fraterna.
                            </p>
                            <p style="text-indent: 2rem;">
                                Las Grandes Zonas surgieron a partir de un decreto emitido por el Venerable Gran Maestro de la Gran Logia de la República de Venezuela, con el objetivo de otorgar un orden estructural y jerárquico a todas las zonas a nivel nacional. Este decreto buscaba fortalecer la coordinación entre las logias y optimizar la administración de los asuntos masónicos en cada región del país, garantizando la unidad de criterios y la eficiencia en los trabajos de la Augusta Institución.
                            </p>
                        </div>
                    </div>
                    <blockquote class="p-8 bg-gradient-to-r from-blue-100 to-indigo-100 rounded-xl border border-blue-200 flex items-center justify-center">
                        <div>
                            <p class="text-xl font-medium text-blue-800 italic text-center">"Buscamos hacer de hombres buenos, mejores hombres. Hombres comprometidos con su entorno, su familia y su país."</p>
                            <div class="mt-4 text-blue-600 font-semibold text-center">— Sabiduría Masónica</div>
                        </div>
                    </blockquote>
                </div>
            </div>
        </div>

        <!-- Misión y Visión Section -->
        <div class="bg-gradient-to-br from-gray-50 to-blue-50 py-16" data-scroll-reveal>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-extrabold text-primary-600 font-serif">Misión y Visión</h2>
                    <p class="mt-4 text-lg text-gray-500">Nuestro propósito y rumbo como institución masónica</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-blue-500 hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-2xl font-extrabold text-gray-900 font-serif mb-6 flex items-center">
                            <i class="ri-focus-3-line text-blue-500 text-2xl mr-3"></i>
                            <span class="font-semibold">Misión</span>
                        </h3>
                        <p class="text-gray-700 text-lg leading-relaxed">
                            Preservar y transmitir los principios universales de la Francmasonería: Libertad, Igualdad y Fraternidad. Fomentamos el estudio filosófico, el desarrollo moral y la práctica de la filantropía entre nuestros miembros, fortaleciendo así la identidad masónica.
                        </p>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-lg p-8 border-l-4 border-green-500 hover:shadow-xl transition-shadow duration-300">
                        <h3 class="text-2xl font-extrabold text-gray-900 font-serif mb-6 flex items-center">
                            <i class="ri-eye-line text-green-500 text-2xl mr-3"></i>
                            <span class="font-semibold">Visión</span>
                        </h3>
                        <p class="text-gray-700 text-lg leading-relaxed">
                            Aspiramos a ser una institución relevante y respetada, reconocida por su contribución positiva al progreso de la sociedad guayanesa, formando líderes éticos y ciudadanos ejemplares que trabajen por el bienestar común y el fortalecimiento de la Gran Logia de Venezuela.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pilares Section -->
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8" data-scroll-reveal>
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl font-extrabold text-primary-600 font-serif">Nuestros Pilares</h2>
                <p class="mt-4 text-lg text-gray-500">La Gran Logia de la República de Venezuela se sustenta en las cuatro columnas fundamentales que han fortalecido la Masonería Nacional: Amor Fraternal, Sentido de Pertenencia, Filantropía y Docencia Masónica, guiando nuestro trabajo y compromiso como MRGM.</p>
            </div>
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl p-8 shadow-lg border border-blue-100 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mx-auto mb-6">
                        <i class="ri-heart-line text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Amor Fraternal</h4>
                    <p class="text-gray-600 text-sm">Lazos de unión entre los Queridos Hermanos que fortalecen la fraternidad y el respeto mutuo.</p>
                </div>
                
                <div class="bg-gradient-to-br from-green-50 to-teal-50 rounded-xl p-8 shadow-lg border border-green-100 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-green-100 text-green-600 mx-auto mb-6">
                        <i class="ri-book-open-line text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Docencia Masónica</h4>
                    <p class="text-gray-600 text-sm">La búsqueda incesante de la verdad y el conocimiento para el perfeccionamiento masónico.</p>
                </div>
                
                <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl p-8 shadow-lg border border-yellow-100 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-amber-100 text-amber-600 mx-auto mb-6">
                        <i class="ri-hand-heart-line text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Filantropía</h4>
                    <p class="text-gray-600 text-sm">El amor a la humanidad manifestado en obras de caridad y beneficencia.</p>
                </div>
                
                <div class="bg-gradient-to-br from-purple-50 to-indigo-50 rounded-xl p-8 shadow-lg border border-purple-100 text-center hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-purple-100 text-purple-600 mx-auto mb-6">
                        <i class="ri-shield-star-line text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Sentido de Pertenencia</h4>
                    <p class="text-gray-600 text-sm">El orgullo y compromiso hacia nuestra Orden, Logia y Hermanos.</p>
                </div>
            </div>
        </div>

        <!-- Junta Directiva Section -->
        <div class="bg-gradient-to-br from-gray-50 to-blue-50 py-16" data-scroll-reveal>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <h2 class="text-3xl font-extrabold text-primary-600 font-serif">Nuestra Junta Directiva</h2>
                    <p class="mt-4 text-lg text-gray-500">El equipo que lidera y coordina los trabajos de la Gran Zona 5.</p>
                </div>
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach ($boardMembers as $member)
                        @php
                            $slug = Str::slug($member->name);
                            $imageUrl = "https://picsum.photos/seed/{$slug}/500/500";
                        @endphp
                        <x-card-member :image="$imageUrl" :name="$member->name" :role="$member->role" :slug="$slug" />
                    @endforeach
                </div>

                @foreach ($boardMembers as $member)
                    @php
                        $slug = Str::slug($member->name);
                        $imageUrl = "https://picsum.photos/seed/{$slug}/500/500";
                    @endphp
                    <x-modal :name="$slug" maxWidth="lg">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row items-center">
                                <img class="h-32 w-32 rounded-full object-cover shadow-lg flex-shrink-0" src="{{ $imageUrl }}" alt="">
                                <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $member->name }}</h3>
                                    <p class="text-lg text-primary-600 font-semibold">{{ $member->role }}</p>
                                </div>
                            </div>
                            <p class="mt-6 text-gray-600 text-justify">{{ $member->bio ?? 'Biografía no disponible.' }}</p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close-modal', '{{ $slug }}')">
                                    Cerrar
                                </x-secondary-button>
                            </div>
                        </div>
                    </x-modal>
                @endforeach
            </div>
        </div>
    </div>
@endsection
