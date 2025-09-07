<div {{ $attributes->merge(['class' => 'bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border border-transparent hover:border-primary-500']) }}>
    @if(isset($image))
        <div class="flex-shrink-0">
            <img class="h-48 w-full object-cover" src="{{ $image }}" alt="{{ $title ?? '' }}">
        </div>
    @endif
    <div class="p-6 flex flex-col justify-between">
        @if(isset($type))
            <p class="text-sm font-medium text-primary-600">{{ strtoupper($type) }}</p>
        @endif
        <h3 class="mt-2 text-xl font-semibold text-gray-900">{{ $title ?? '' }}</h3>
        @if(isset($subtitle))
            <p class="mt-2 text-base text-gray-500">{{ $subtitle }}</p>
        @endif
        <div class="mt-4">
            {{ $slot }}
        </div>
        @if(isset($link))
            <div class="mt-6">
                <a href="{{ $link }}" class="inline-flex items-center font-semibold text-primary-600 hover:text-primary-500">
                    Leer más <span aria-hidden="true">&rarr;</span>
                </a>
            </div>
        @endif
    </div>
</div>
