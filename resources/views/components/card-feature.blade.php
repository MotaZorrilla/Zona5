@props(['icon', 'title', 'subtitle', 'link' => '#', 'borderColor' => 'border-primary-500'])

<a href="{{ $link }}" class="block group h-full">
    <x-card class="text-center items-center p-8 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-t-4 {{ $borderColor }}">
        @if($slot->isNotEmpty())
            {{ $slot }}
        @else
            <div class="flex items-center justify-center h-16 w-16 rounded-full bg-primary-500 text-white mx-auto mb-6">
                <i class="{{ $icon }} text-4xl"></i>
            </div>
        @endif
        <h3 class="text-xl font-bold text-gray-900 font-serif group-hover:text-primary-700 transition-colors duration-300 line-clamp-2">{{ $title }}</h3>
        <p class="mt-2 text-gray-600 line-clamp-3">{{ $subtitle }}</p>
    </x-card>
</a>
