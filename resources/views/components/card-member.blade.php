@props(['image', 'name', 'role', 'slug'])

<div class="group text-center cursor-pointer" x-on:click="$dispatch('open-modal', '{{ $slug }}')">
    <x-card class="p-0 overflow-visible transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 ring-2 ring-transparent hover:ring-primary-500">
        <div class="relative pt-12 pb-6 bg-gray-50 rounded-t-lg">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <img class="w-24 h-24 rounded-full object-cover mx-auto shadow-lg border-4 border-white"
                     src="{{ $image }}" alt="Foto de {{ $name }}">
            </div>
        </div>
        <div class="p-6">
            <h4 class="text-xl font-bold text-gray-900 line-clamp-1">{{ $name }}</h4>
            <p class="text-primary-600 font-semibold line-clamp-1">{{ $role }}</p>
            <div class="mt-4">
                <span class="inline-flex items-center text-sm font-medium text-primary-700 group-hover:text-primary-900">
                    Ver más
                    <i class="ri-arrow-right-line ml-1"></i>
                </span>
            </div>
        </div>
    </x-card>
</div>
