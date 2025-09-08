@extends('layouts.public')

@section('title', 'Dignatarios de Logia')

@section('content')
    <x-public.hero 
        title="Asilo de la Paz N° 13" 
        subtitle="Dignatarios y Oficiales para el período 2024-2025"
        imageUrl="https://picsum.photos/seed/hero-lodge-show/1920/1080"
    />

    <div class="bg-white py-24 sm:py-32" x-data="{ activeModal: null }">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:mx-0" data-scroll-reveal>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl font-serif">Conoce a Nuestros Líderes</h2>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    El taller está guiado por un equipo de Hermanos dedicados, comprometidos con los principios de la francmasonería y el bienestar de nuestra Logia.
                </p>
            </div>
            <ul role="list" class="mx-auto mt-20 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:grid-cols-2 lg:mx-0 lg:max-w-none lg:grid-cols-3" data-scroll-reveal>
                @php
                    $dignitaries = [
                        ['name' => 'Luis Bartolo', 'role' => 'Venerable Maestro', 'image' => 'https://picsum.photos/seed/person1/500/500', 'bio' => 'Bio de ejemplo para Luis Bartolo. Aquí iría una breve descripción de su trayectoria y rol en la logia.'],
                        ['name' => 'Carlos Larreal', 'role' => 'Primer Vigilante', 'image' => 'https://picsum.photos/seed/person2/500/500', 'bio' => 'Bio de ejemplo para Carlos Larreal. Aquí iría una breve descripción de su trayectoria y rol en la logia.'],
                        ['name' => 'Pedro González', 'role' => 'Segundo Vigilante', 'image' => 'https://picsum.photos/seed/person3/500/500', 'bio' => 'Bio de ejemplo para Pedro González. Aquí iría una breve descripción de su trayectoria y rol en la logia.'],
                        ['name' => 'José Fernández', 'role' => 'Orador Fiscal', 'image' => 'https://picsum.photos/seed/person4/500/500', 'bio' => 'Bio de ejemplo para José Fernández. Aquí iría una breve descripción de su trayectoria y rol en la logia.'],
                        ['name' => 'Miguel Rodríguez', 'role' => 'Secretario', 'image' => 'https://picsum.photos/seed/person5/500/500', 'bio' => 'Bio de ejemplo para Miguel Rodríguez. Aquí iría una breve descripción de su trayectoria y rol en la logia.'],
                        ['name' => 'David Martínez', 'role' => 'Tesorero', 'image' => 'https://picsum.photos/seed/person6/500/500', 'bio' => 'Bio de ejemplo para David Martínez. Aquí iría una breve descripción de su trayectoria y rol en la logia.'],
                        ['name' => 'Antonio Pérez', 'role' => 'Maestro de Ceremonias', 'image' => 'https://picsum.photos/seed/person7/500/500', 'bio' => 'Bio de ejemplo para Antonio Pérez. Aquí iría una breve descripción de su trayectoria y rol en la logia.'],
                        ['name' => 'Jesús Gómez', 'role' => 'Guarda Templo Interior', 'image' => 'https://picsum.photos/seed/person8/500/500', 'bio' => 'Bio de ejemplo para Jesús Gómez. Aquí iría una breve descripción de su trayectoria y rol en la logia.'],
                    ];
                @endphp

                @foreach ($dignitaries as $dignitary)
                <li>
                    <div class="group bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 ring-2 ring-transparent hover:ring-primary-500 cursor-pointer" x-on:click="$dispatch('open-modal', '{{ Str::slug($dignitary['name']) }}')">
                        <div class="pt-8 pb-4 bg-gray-50">
                            <img class="w-32 h-32 rounded-full object-cover mx-auto shadow-md" src="{{ $dignitary['image'] }}" alt="Foto de {{ $dignitary['name'] }}">
                        </div>
                        <div class="p-6 text-center">
                            <h4 class="text-xl font-bold text-gray-900">{{ $dignitary['name'] }}</h4>
                            <p class="text-primary-600 font-semibold">{{ $dignitary['role'] }}</p>
                            <div class="mt-4">
                                <span class="inline-flex items-center text-sm font-medium text-primary-700">
                                    Ver más
                                    <i class="ri-arrow-right-line ml-1"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <x-modal :name="Str::slug($dignitary['name'])" maxWidth="lg">
                        <div class="p-6">
                            <div class="flex flex-col sm:flex-row items-center">
                                <img class="h-32 w-32 rounded-full object-cover shadow-lg flex-shrink-0" src="{{ $dignitary['image'] }}" alt="">
                                <div class="mt-4 sm:mt-0 sm:ml-6 text-center sm:text-left">
                                    <h3 class="text-2xl font-bold text-gray-900">{{ $dignitary['name'] }}</h3>
                                    <p class="text-lg text-primary-600 font-semibold">{{ $dignitary['role'] }}</p>
                                </div>
                            </div>
                            <p class="mt-6 text-gray-600 text-justify">{{ $dignitary['bio'] }}</p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close-modal', '{{ Str::slug($dignitary['name']) }}')">
                                    Cerrar
                                </x-secondary-button>
                            </div>
                        </div>
                    </x-modal>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
