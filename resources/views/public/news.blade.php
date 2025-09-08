@extends('layouts.public')

@section('title', 'Noticias y Eventos')

@section('content')
    <x-public.hero 
        title="Noticias y Eventos" 
        subtitle="Mantente al día con las últimas novedades de la Gran Zona 5."
        imageUrl="https://picsum.photos/seed/news-hero/1920/1080"
    />

    <div class="py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            {{-- Filter Bar Mockup --}}
            <div class="mb-12 flex justify-center space-x-4">
                <x-button variant="primary" size="sm">Todos</x-button>
                <x-button variant="secondary" size="sm">Noticias</x-button>
                <x-button variant="secondary" size="sm">Eventos</x-button>
                <x-button variant="secondary" size="sm">Galerías</x-button>
            </div>

            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <x-card-image image="https://picsum.photos/seed/news-card1/800/600" title="Tenida de Solsticio de Invierno" subtitle="Invitamos a todos los QQ.`.`HH.`.` a la magna tenida que se celebrará en el Templo Principal." type="Evento" link="#">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        <time datetime="2025-06-21" class="text-gray-500">21 Jun, 2025</time>
                    </div>
                </x-card-image>
                <x-card-image image="https://picsum.photos/seed/news-card2/800/600" title="Conferencia sobre Historia Masónica" subtitle="El historiador Q.`.`H.`.` Manuel Castillo presentará su último trabajo sobre la masonería en el siglo XIX." type="Noticia" link="#">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        <time datetime="2025-07-15" class="text-gray-500">15 Jul, 2025</time>
                    </div>
                </x-card-image>
                <x-card-image image="https://picsum.photos/seed/news-card3/800/600" title="Jornada de Voluntariado" subtitle="Nuestra tradicional jornada de voluntariado se realizará en el ancianato local. ¡Inscríbete!" type="Comunicado" link="#">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        <time datetime="2025-08-01" class="text-gray-500">01 Ago, 2025</time>
                    </div>
                </x-card-image>
                {{-- New items --}}
                <x-card-image image="https://picsum.photos/seed/gallery1/800/600" title="Galería: Visita al Templo Histórico" subtitle="Un recorrido fotográfico por la reciente visita de los hermanos al Templo de la Logia 'Luz del Orinoco'." type="Galería" link="#">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        <time datetime="2025-08-10" class="text-gray-500">10 Ago, 2025</time>
                        <i class="ri-image-line text-lg text-primary-500"></i>
                    </div>
                </x-card-image>
                <x-card-image image="https://picsum.photos/seed/news-card4/800/600" title="Comunicado: Horarios de Receso" subtitle="Información importante sobre los horarios de receso de actividades durante el mes de diciembre." type="Comunicado" link="#">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        <time datetime="2025-09-01" class="text-gray-500">01 Sep, 2025</time>
                    </div>
                </x-card-image>
                <x-card-image image="https://picsum.photos/seed/event2/800/600" title="Evento: Cena de Confraternidad Anual" subtitle="Detalles sobre la cena anual de confraternidad, un espacio para fortalecer los lazos fraternales." type="Evento" link="#">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        <time datetime="2025-10-05" class="text-gray-500">05 Oct, 2025</time>
                    </div>
                </x-card-image>
            </div>
        </div>
    </div>
@endsection
