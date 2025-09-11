<div>
    <h4 class="font-bold text-lg text-gray-800 mb-4">Miembros por Logia</h4>
    <div class="flex justify-between mb-4">
        <button wire:click="sort('name')" class="px-3 py-1 text-sm font-medium rounded-md focus:outline-none
            {{ $sortBy === 'name' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Ordenar por Nombre
            @if ($sortBy === 'name')
                @if ($sortDirection === 'asc')
                    <i class="ri-arrow-up-s-line"></i>
                @else
                    <i class="ri-arrow-down-s-line"></i>
                @endif
            @endif
        </button>
        <button wire:click="sort('users_count')" class="px-3 py-1 text-sm font-medium rounded-md focus:outline-none
            {{ $sortBy === 'users_count' ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
            Ordenar por Miembros
            @if ($sortBy === 'users_count')
                @if ($sortDirection === 'asc')
                    <i class="ri-arrow-up-s-line"></i>
                @else
                    <i class="ri-arrow-down-s-line"></i>
                @endif
            @endif
        </button>
    </div>
    <div class="space-y-4">
        @php
            $colors = ['#4f46e5', '#ec4899', '#f59e0b', '#38bdf8', '#14b8a6'];
        @endphp
        @forelse ($lodges as $lodge)
            <div wire:key="{{ $lodge->id }}">
                <div class="flex justify-between text-sm mb-1">
                    <span class="truncate">{{ $lodge->name }}</span>
                    <span>{{ $lodge->users_count }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="h-2.5 rounded-full" style="width: {{ $maxMembers > 0 ? ($lodge->users_count / $maxMembers) * 100 : 0 }}%; background-color: {{ $colors[$loop->index % count($colors)] }}"></div>
                </div>
            </div>
        @empty
            <p class="text-sm text-gray-500">No hay datos de logias para mostrar.</p>
        @endforelse
    </div>
</div>