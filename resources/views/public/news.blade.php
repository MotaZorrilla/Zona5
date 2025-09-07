@extends('layouts.public')

@section('title', 'Noticias y Eventos')

@section('content')
    <x-public.hero 
        title="Noticias y Eventos" 
        subtitle="Mantente al día con las últimas novedades de la Gran Zona 5."
        imageUrl="https://picsum.photos/seed/news-hero/1920/1080"
    />

    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <x-card image="https://picsum.photos/seed/news-card1/800/600" title="Tenida de Solsticio de Invierno" subtitle="Invitamos a todos los QQ.`.`HH.`.` a la magna tenida que se celebrará en el Templo Principal." type="Evento" link="#">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        <time datetime="2025-06-21" class="text-gray-500">21 Jun, 2025</time>
                    </div>
                </x-card>
                <x-card image="https://picsum.photos/seed/news-card2/800/600" title="Conferencia sobre Historia Masónica" subtitle="El historiador Q.`.`H.`.` Manuel Castillo presentará su último trabajo sobre la masonería en el siglo XIX." type="Noticia" link="#">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        <time datetime="2025-07-15" class="text-gray-500">15 Jul, 2025</time>
                    </div>
                </x-card>
                <x-card image="https://picsum.photos/seed/news-card3/800/600" title="Jornada de Voluntariado" subtitle="Nuestra tradicional jornada de voluntariado se realizará en el ancianato local. ¡Inscríbete!" type="Comunicado" link="#">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        <time datetime="2025-08-01" class="text-gray-500">01 Ago, 2025</time>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
@endsection