@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md'
])

@php
$baseClasses = 'inline-flex items-center justify-center rounded-md border border-transparent font-medium shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 transition-all duration-300 ease-in-out';

$variantClasses = [
    'primary' => 'bg-primary text-white hover:bg-primary-700 focus:ring-primary-500',
        'primary' => 'bg-primary-600 text-white hover:bg-primary-700 focus:ring-primary-500',
    'secondary' => 'bg-white text-primary-600 hover:bg-gray-50 focus:ring-primary-500',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500',
][$variant] ?? 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500';

$sizeClasses = [
    'sm' => 'px-4 py-2 text-sm',
    'md' => 'px-8 py-3 text-base md:py-4 md:text-lg md:px-10',
    'lg' => 'px-10 py-4 text-lg md:py-5 md:text-xl md:px-12',
][$size] ?? 'px-6 py-3 text-base';

$classes = $baseClasses . ' ' . $variantClasses . ' ' . $sizeClasses;
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
