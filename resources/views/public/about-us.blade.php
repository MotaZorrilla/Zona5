@extends('layouts.public')

@section('title', 'Quiénes Somos - Gran Zona 5')

@section('content')
    {{-- Header con Imagen de Fondo --}}
    <div class="relative bg-primary-800">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1521737852567-6949f3f9f2b5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2830&q=80&sat=-100" alt="Equipo trabajando">
            <div class="absolute inset-0 bg-primary-800 mix-blend-multiply" aria-hidden="true"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Quiénes Somos</h1>
            <p class="mt-6 text-xl text-primary-100 max-w-3xl">Un recorrido por la historia y el propósito de la Masonería en la Gran Zona 5 del Estado Bolívar.</p>
        </div>
    </div>

    {{-- Contenido Principal --}}
    <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="prose prose-primary prose-lg text-gray-500 mx-auto">
            <h2>Nuestra Historia</h2>
            <p>La Masonería en la región de Guayana tiene raíces profundas, entrelazadas con el desarrollo social, cultural y político del Estado Bolívar. Desde la fundación de las primeras logias, los hermanos masones han sido pilares en la construcción de una sociedad más justa, educada y fraterna.</p>
            <p>La Gran Zona 5, jurisdiccionada a la Muy Respetable Gran Logia de la República de Venezuela, agrupa a las logias de esta vasta y rica región, continuando un legado de más de un siglo de trabajo ininterrumpido en pro de la humanidad.</p>

            <blockquote class="border-l-4 border-primary-500 pl-4">
                <p class="font-semibold">"Buscamos hacer de hombres buenos, mejores hombres. Hombres comprometidos con su entorno, su familia y su país."</p>
            </blockquote>

            <h2>Misión y Visión</h2>
            <p>Nuestra misión es la de preservar y transmitir los principios universales de la Francmasonería: Libertad, Igualdad y Fraternidad. Fomentamos el estudio filosófico, el desarrollo moral y la práctica de la filantropía entre nuestros miembros.</p>
            <p>Aspiramos a ser una institución relevante y respetada, reconocida por su contribución positiva al progreso de la sociedad guayanesa, formando líderes éticos y ciudadanos ejemplares que trabajen por el bienestar común desde sus respectivos campos de acción.</p>

            <h2>Nuestros Valores</h2>
            <ul>
                <li><strong>Tolerancia:</strong> Respeto absoluto por las ideas y creencias de los demás.</li>
                <li><strong>Fraternidad:</strong> Lazos de hermandad y ayuda mutua que nos unen más allá de cualquier diferencia.</li>
                <li><strong>Progreso:</strong> La búsqueda constante del perfeccionamiento individual y colectivo a través del estudio y el trabajo.</li>
            </ul>
        </div>
    </div>
@endsection
