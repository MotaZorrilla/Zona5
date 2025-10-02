@props([
    'image',
    'title',
    'subtitle',
    'type' => null,
    'link' => '#',
    'thumbnail' => null,
])

@php
    $typeClasses = [
        'Evento' => 'bg-blue-100 text-blue-800 border-blue-500',
        'Noticia' => 'bg-green-100 text-green-800 border-green-500',
        'Comunicado' => 'bg-yellow-100 text-yellow-800 border-yellow-500',
        'Galería' => 'bg-purple-100 text-purple-800 border-purple-500',
        'Documento' => 'bg-indigo-100 text-indigo-800 border-indigo-500',
    ];
    
    $currentTypeClass = $typeClasses[$type] ?? 'bg-gray-100 text-gray-800 border-gray-400';
    $cardBorderColor = $typeClasses[$type] ?? 'border-gray-400';
@endphp

<a href="{{ $link }}" class="block group h-full">
    <x-card class="border-2 {{ $cardBorderColor }} group-hover:border-4">
        @if($thumbnail)
            <div class="overflow-hidden">
                <img class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $thumbnail }}" alt="Miniatura de {{ $title }}">
            </div>
        @elseif($image)
            <div class="overflow-hidden">
                <img class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300" src="{{ $image }}" alt="{{ $title }}">
            </div>
        @endif
        
        <div class="p-6 flex flex-col flex-grow">
            @if($type)
                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full mb-2 {{ $currentTypeClass }}">{{ $type }}</span>
            @endif
            
            <h3 class="text-xl font-bold text-gray-900 font-serif group-hover:text-primary-700 transition-colors duration-300 line-clamp-2">{{ $title }}</h3>
            <p class="mt-2 text-gray-600 flex-grow line-clamp-3">{{ $subtitle }}</p>
            
            @if($slot->isNotEmpty())
                <div class="mt-4 pt-4 border-t border-gray-100">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </x-card>
</a>