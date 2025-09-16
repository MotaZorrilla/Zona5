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
            @php
                // Obtener todas las logias desde la base de datos
                $lodges = \App\Models\Lodge::orderBy('orient')->orderBy('number')->get();
                
                // Agrupar logias por orient
                $lodgesByOrient = $lodges->groupBy('orient');
            @endphp

            <!-- Menú de navegación rápida por orientes -->
            <div class="mb-12 flex flex-wrap justify-center gap-4" data-scroll-reveal>
                @foreach($lodgesByOrient as $orient => $lodgeGroup)
                <a href="#{{ Str::slug($orient) }}" class="px-4 py-2 bg-primary-100 text-primary-800 rounded-full font-medium hover:bg-primary-200 transition-colors duration-300">
                    {{ $orient }}
                </a>
                @endforeach
            </div>

            @foreach($lodgesByOrient as $orient => $lodgeGroup)
            <div class="mb-24" id="{{ Str::slug($orient) }}" data-scroll-reveal>
                <h2 class="text-3xl font-extrabold text-gray-900 font-serif text-center mb-12 border-b pb-4">
                    Logias de {{ $orient }}
                </h2>
                <ul role="list" class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                    @foreach($lodgeGroup as $lodge)
                    <li>
                        <x-card-image 
                            image="https://picsum.photos/seed/{{ $lodge->slug }}/800/600" 
                            title="{{ $lodge->name }} N° {{ $lodge->number }}" 
                            subtitle="Oriente de {{ $lodge->orient }}" 
                            link="{{ route('public.lodges.show', $lodge->slug) }}" 
                        />
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
    </div>
@endsection
