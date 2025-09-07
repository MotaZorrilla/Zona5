@extends('layouts.public')

@section('title', 'Noticias y Eventos')

@section('content')
    <x-public.hero 
        title="Noticias y Eventos" 
        subtitle="Mantente al día con las últimas novedades de la Gran Zona 5."
        imageUrl="https://images.unsplash.com/photo-1516412241077-a79a8934b54b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80"
    />

    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <x-card image="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" title="Tenida de Solsticio de Invierno" subtitle="Invitamos a todos los QQ.`.`HH.`.` a la magna tenida que se celebrará en el Templo Principal." type="Evento" link="#">
                    <div class="mt-8 flex items-center gap-x-4 text-xs">
                        <time datetime="2020-06-21" class="text-gray-500">21 Jun, 2025</time>
                    </div>
                </x-card>
                <!-- More posts... -->
            </div>
        </div>
    </div>
@endsection
