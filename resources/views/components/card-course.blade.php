@props([
    'image',
    'title',
    'subtitle',
    'grade' => null,
    'link' => '#',
])

@php
    $gradeColor = [
        'Primer Grado' => 'border-blue-500',
        'Segundo Grado' => 'border-green-500',
        'Tercer Grado' => 'border-purple-500',
        'Grados Superiores' => 'border-yellow-500',
    ];
    $currentGradeColor = $gradeColor[$grade] ?? 'border-gray-400';
@endphp

<x-card class="p-0 overflow-hidden border border-slate-200 hover:border-primary-500 transition-all duration-300 border-t-4 {{ $currentGradeColor }}">
    @if($image)
        <div class="overflow-hidden">
            <img class="w-full h-48 object-cover" src="{{ $image }}" alt="Imagen del curso: {{ $title }}">
        </div>
    @endif
    <div class="p-6 flex flex-col flex-grow">
        @if($grade)
            <p class="text-sm font-semibold text-primary-600 mb-2">Grado: {{ $grade }}</p>
        @endif
        <h3 class="text-xl font-bold text-gray-900 font-serif">{{ $title }}</h3>
        <p class="mt-2 text-gray-600 flex-grow">{{ $subtitle }}</p>
    </div>

    <div class="p-6 border-t border-gray-100">
        @guest
            <x-button href="{{ route('login') }}" class="w-full">
                Inicia Sesión para Ver Curso
            </x-button>
        @endguest
        @auth
            <x-button href="{{ $link }}" class="w-full" size="sm">
                Ver Curso
            </x-button>
        @endauth
    </div>
</x-card>
