@extends('layouts.public')

@section('title', 'Bienvenido a la Gran Zona 5')

@section('content')
    <!-- Header & Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="absolute inset-0">
            <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="Biblioteca">
            <div class="absolute inset-0 bg-gray-900 bg-opacity-75"></div>
        </div>
        <div class="relative max-w-7xl mx-auto pt-48 pb-24 px-4 sm:px-6 lg:px-8">
            <!-- Hero Content -->
            <div class="text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl font-serif">
                    <span class="block">Tradición y Futuro</span>
                    <span class="block text-primary-300">Uniendo la Masonería</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-300 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Un espacio para el encuentro, el conocimiento y la fraternidad de todas las Logias que conforman la Gran Zona 5 de la Gran Logia de la República de Venezuela.
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <x-button href="#" size="md">Conoce las Logias</x-button>
                    <div class="mt-3 sm:mt-0 sm:ml-3">
                        <x-button href="#" variant="secondary" size="md">Explora el Archivo</x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pillars Section -->
    <div class="bg-gray-50" data-scroll-reveal>
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 font-serif">Nuestros Pilares</h2>
                <p class="mt-4 text-lg text-gray-500">Fomentando los valores que nos unen y nos hacen crecer.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <x-card-feature icon="ri-archive-line" title="Conocimiento" subtitle="Accede a un repositorio de planchas, trazados y documentos para el estudio y la reflexión." link="#" borderColor="border-primary-500" />
                <x-card-feature icon="ri-group-2-line" title="Fraternidad" subtitle="Encuentra información sobre las logias de la zona y fortalece los lazos que nos unen." link="#" borderColor="border-pink-500" />
                <x-card-feature icon="ri-calendar-event-line" title="Comunidad" subtitle="Mantente al día con las últimas noticias, eventos y comunicados de la Gran Zona 5." link="#" borderColor="border-green-500" />
            </div>
        </div>
    </div>

    <!-- News Section -->
    <div class="bg-white py-16" data-scroll-reveal>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 font-serif">Últimas Noticias y Eventos</h2>
                <p class="mt-4 text-lg text-gray-500">La actualidad de nuestra zona, al alcance de todos.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <x-card-image image="https://picsum.photos/seed/welcome-card1/800/600" title="Tenida de Solsticio de Invierno" subtitle="Invitamos a todos los QQ.`.`HH.`.` a la magna tenida que se celebrará en el Templo Principal." type="Evento" link="#" borderColor="border-blue-500">
                    <div class="mt-6 flex items-center">
                        <div class="text-sm text-gray-500">21 de Junio, 2025</div>
                    </div>
                </x-card-image>
                <x-card-image image="https://picsum.photos/seed/welcome-card2/800/600" title="Balance Anual de la Gran Zona 5" subtitle="El Gran Delegado Zonal presenta el balance de los trabajos y el crecimiento de la membresía." type="noticia" link="#" borderColor="border-green-500">
                    <div class="mt-6 flex items-center">
                        <div class="text-sm text-gray-500">15 de Septiembre, 2025</div>
                    </div>
                </x-card-image>
                <x-card-image image="https://picsum.photos/seed/welcome-card3/800/600" title="Nueva Edición del Manual de Rito" subtitle="Ya se encuentra disponible en el repositorio la nueva edición revisada del manual del R.`.`E.`.`A.`.`A.`.`" type="comunicado" link="#" borderColor="border-yellow-500">
                    <div class="mt-6 flex items-center">
                        <div class="text-sm text-gray-500">1 de Septiembre, 2025</div>
                    </div>
                </x-card-image>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-primary-700" data-scroll-reveal>
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl font-serif">
                <span class="block">Fortaleciendo nuestros lazos.</span>
                <span class="block">Iluminando nuestro camino.</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-primary-200">¿Eres un hermano de visita? ¿Interesado en conocer más sobre nuestros trabajos? Contáctanos.</p>
            <x-button href="#" variant="secondary" class="mt-8 w-full sm:w-auto">Ponerse en Contacto</x-button>
        </div>
    </div>
@endsection
