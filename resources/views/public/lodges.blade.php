@extends('layouts.public')

@section('title', 'Logias de la Gran Zona 5')

@section('content')
    <x-public.hero 
        title="Nuestras Logias" 
        subtitle="Un crisol de tradición y fraternidad a lo largo de la Gran Zona 5."
        imageUrl="https://picsum.photos/seed/hero-lodges/1920/1080"
    />

    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            <!-- Logias de Ciudad Guayana -->
            <div class="mb-24" data-scroll-reveal>
                <h2 class="text-3xl font-extrabold text-gray-900 font-serif text-center mb-12 border-b pb-4">Logias de Ciudad Guayana</h2>
                <ul role="list" class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    <li>
                        <x-card-image image="https://picsum.photos/seed/lodge-cg1/800/600" title="Sol de Guayana N° 88" subtitle="Orient de Ciudad Guayana" link="{{ route('public.lodges.show', 'sol-de-guayana-88') }}" />
                    </li>
                    <li>
                        <x-card-image image="https://picsum.photos/seed/lodge-cg2/800/600" title="Aurora del Orinoco N° 11" subtitle="Orient de Ciudad Guayana" link="{{ route('public.lodges.show', 'aurora-del-orinoco-11') }}" />
                    </li>
                    <li>
                        <x-card-image image="https://picsum.photos/seed/lodge-cg3/800/600" title="Luz de Orient N° 25" subtitle="Orient de Ciudad Guayana" link="{{ route('public.lodges.show', 'luz-de-oriente-25') }}" />
                    </li>
                </ul>
            </div>

            <!-- Logias de Upata -->
            <div class="mb-24" data-scroll-reveal>
                <h2 class="text-3xl font-extrabold text-gray-900 font-serif text-center mb-12 border-b pb-4">Logias de Upata</h2>
                <ul role="list" class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    <li>
                        <x-card-image image="https://picsum.photos/seed/lodge-up1/800/600" title="Piar y Sucre N° 150" subtitle="Orient de Upata" link="{{ route('public.lodges.show', 'piar-y-sucre-150') }}" />
                    </li>
                    <li>
                        <x-card-image image="https://picsum.photos/seed/lodge-up2/800/600" title="Fraternidad del Yuruari N° 180" subtitle="Orient de Upata" link="{{ route('public.lodges.show', 'fraternidad-del-yuruari-180') }}" />
                    </li>
                    <li>
                        <x-card-image image="https://picsum.photos/seed/lodge-up3/800/600" title="Unión y Progreso N° 5" subtitle="Orient de Upata" link="{{ route('public.lodges.show', 'union-y-progreso-5') }}" />
                    </li>
                </ul>
            </div>

            <!-- Logias de Ciudad Bolívar -->
            <div data-scroll-reveal>
                <h2 class="text-3xl font-extrabold text-gray-900 font-serif text-center mb-12 border-b pb-4">Logias de Ciudad Bolívar</h2>
                <ul role="list" class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    <li>
                        <x-card-image image="https://picsum.photos/seed/lodge-cb1/800/600" title="Asilo de la Paz N° 13" subtitle="Orient de Ciudad Bolívar" link="{{ route('public.lodges.show', 'asilo-de-la-paz-13') }}" />
                    </li>
                    <li>
                        <x-card-image image="https://picsum.photos/seed/lodge-cb2/800/600" title="Moral y Luces N° 3" subtitle="Orient de Ciudad Bolívar" link="{{ route('public.lodges.show', 'moral-y-luces-3') }}" />
                    </li>
                    <li>
                        <x-card-image image="https://picsum.photos/seed/lodge-cb3/800/600" title="Libertad y Orden N° 7" subtitle="Orient de Ciudad Bolívar" link="{{ route('public.lodges.show', 'libertad-y-orden-7') }}" />
                    </li>
                </ul>
            </div>

        </div>
    </div>
@endsection
