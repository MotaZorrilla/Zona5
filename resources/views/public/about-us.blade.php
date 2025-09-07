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
    <div class="bg-white">
        <!-- Historia Section -->
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
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
        <div class="bg-gray-50">
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

        <!-- Valores Section -->
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 font-serif">Nuestros Valores</h2>
                <p class="mt-4 text-lg text-gray-500">Los pilares que guían nuestro trabajo y fortalecen nuestra fraternidad.</p>
            </div>
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mx-auto mb-6">
                        <i class="ri-scales-3-line text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900">Tolerancia</h4>
                    <p class="mt-2 text-gray-500">Respeto absoluto por las ideas y creencias de los demás.</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mx-auto mb-6">
                        <i class="ri-group-2-line text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900">Fraternidad</h4>
                    <p class="mt-2 text-gray-500">Lazos de hermandad y ayuda mutua que nos unen más allá de cualquier diferencia.</p>
                </div>
                <div class="text-center">
                    <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-100 text-primary-600 mx-auto mb-6">
                        <i class="ri-line-chart-line text-4xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900">Progreso</h4>
                    <p class="mt-2 text-gray-500">La búsqueda constante del perfeccionamiento individual y colectivo.</p>
                </div>
            </div>
        </div>
    </div>
@endsection