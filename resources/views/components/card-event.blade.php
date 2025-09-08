@props([
    'image' => null,
    'title',
    'subtitle',
    'date',
    'time' => null,
    'instructorName',
    'instructorRole' => null,
    'instructorImage' => null,
    'status' => 'live', // live, upcoming, closed
    'link' => '#',
])

@php
    $statusClasses = [
        'live' => 'bg-red-500 text-white',
        'upcoming' => 'bg-transparent text-primary-600',
        'closed' => 'bg-transparent text-gray-600',
    ];
    $statusIcon = [
        'live' => 'ri-live-fill',
        'upcoming' => 'ri-calendar-event-line',
        'closed' => 'ri-forbid-line',
    ];
    $statusTranslation = [
        'live' => 'EN VIVO',
        'upcoming' => 'PRÓXIMO',
        'closed' => 'FINALIZADO',
    ];
    $buttonText = [
        'live' => 'Acceder Ahora',
        'upcoming' => 'Inscribirse Ahora',
        'closed' => 'Ver Detalles',
    ];
    $buttonVariant = [
        'live' => 'primary',
        'upcoming' => 'primary',
        'closed' => 'secondary',
    ];
    $buttonDisabled = [
        'live' => false,
        'upcoming' => false,
        'closed' => false,
    ];

    $borderColor = [
        'live' => 'border-red-500',
        'upcoming' => 'border-primary-500',
        'closed' => 'border-gray-400',
    ];
@endphp

<x-card class="p-0 overflow-hidden group border border-slate-200 hover:border-primary-500 transition-all duration-300 border-t-4 {{ $borderColor[$status] }}">
    @if($image)
        <div class="overflow-hidden">
            <img class="w-full h-48 object-cover" src="{{ $image }}" alt="Imagen del evento: {{ $title }}">
        </div>
    @endif
    <div class="p-5 min-h-[10.5rem] flex-grow">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 rounded-md p-2 {{ $statusClasses[$status] }}">
                    <i class="{{ $statusIcon[$status] }}"></i>
                </div>
                <span class="ml-3 text-sm font-medium {{ $statusClasses[$status] }}">{{ $statusTranslation[$status] }}</span>
            </div>
            <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($date)->isoFormat('LL') }} @if($time) {{ $time }} @endif</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 font-serif group-hover:text-primary-700 transition-colors duration-300">{{ $title }}</h3>
        <p class="mt-2 text-gray-600">{{ $subtitle }}</p>
    </div>

    <div class="p-5 border-t border-gray-100 flex items-center justify-between bg-gray-50">
        <div class="flex items-center">
            @if($instructorImage)
                <img class="h-10 w-10 rounded-full" src="{{ $instructorImage }}" alt="{{ $instructorName }}">
            @else
                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center"><i class="ri-user-line text-gray-500"></i></div>
            @endif
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-900">{{ $instructorName }}</p>
                @if($instructorRole)
                    <p class="text-sm text-gray-500">{{ $instructorRole }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="p-6 border-t border-gray-100">
        @guest
            <x-button href="{{ route('login') }}" class="w-full" variant="{{ $buttonVariant[$status] }}" :disabled="$buttonDisabled[$status]">
                Inicia Sesión para {{ $buttonText[$status] }}
            </x-button>
        @endguest
        @auth
            <x-button href="{{ $link }}" class="w-full" variant="{{ $buttonVariant[$status] }}" :disabled="$buttonDisabled[$status]" size="sm">
                {{ $buttonText[$status] }}
            </x-button>
        @endauth
    </div>
</x-card>
