@extends('layouts.public')

@section('title', 'Noticias y Eventos')

@section('content')
    <x-public.hero 
        title="Noticias y Eventos" 
        subtitle="Mantente al día con las últimas novedades de la Gran Zona 5."
        imageUrl="https://picsum.photos/seed/news-hero/1920/1080"
    />

    <div class="py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            {{-- Filter Bar --}}
            <div class="mb-12 flex justify-center space-x-4" data-scroll-reveal>
                <x-button variant="primary" size="sm" onclick="showAll()">Todos</x-button>
                <x-button variant="secondary" size="sm" onclick="showNews()">Noticias</x-button>
                <x-button variant="secondary" size="sm" onclick="showEvents()">Eventos</x-button>
                <x-button variant="secondary" size="sm" onclick="showGalleries()">Galerías</x-button>
            </div>

            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3" data-scroll-reveal id="content-container">
                @forelse($news as $item)
                    <x-card-image 
                        :image="$item->image_path ? asset('storage/' . $item->image_path) : 'https://picsum.photos/seed/news-' . $item->id . '/800/600'" 
                        :title="$item->title" 
                        :subtitle="$item->excerpt" 
                        type="Noticia" 
                        link="#"
                    >
                        <div class="mt-8 flex items-center gap-x-4 text-xs">
                            <time datetime="{{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('Y-m-d') : \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}" class="text-gray-500">
                                {{ $item->published_at ? \Carbon\Carbon::parse($item->published_at)->format('d M, Y') : \Carbon\Carbon::parse($item->created_at)->format('d M, Y') }}
                            </time>
                        </div>
                    </x-card-image>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">No hay noticias publicadas en este momento.</p>
                    </div>
                @endforelse

                @foreach($events as $event)
                    <x-card-image 
                        image="https://picsum.photos/seed/event-{{ $event->id }}/800/600" 
                        :title="$event->title" 
                        :subtitle="$event->description" 
                        type="Evento"
                        link="#"
                    >
                        <div class="mt-8 flex items-center gap-x-4 text-xs">
                            <time datetime="{{ $event->start_time->format('Y-m-d') }}" class="text-gray-500">
                                {{ $event->start_time->format('d M, Y') }}
                            </time>
                        </div>
                    </x-card-image>
                @endforeach
            </div>

            {{-- Pagination for news --}}
            @if($news->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function showAll() {
            document.querySelectorAll('#content-container > *').forEach(el => {
                el.style.display = 'block';
            });
        }

        function showNews() {
            // Hide all elements first
            document.querySelectorAll('#content-container > *').forEach(el => {
                el.style.display = 'none';
            });
            
            // Show news cards (those with 'Noticia' type or similar structure)
            const newsCards = document.querySelectorAll('[type="Noticia"], [data-type="noticia"]');
            newsCards.forEach(card => {
                card.style.display = 'block';
            });
        }

        function showEvents() {
            // Hide all elements first
            document.querySelectorAll('#content-container > *').forEach(el => {
                el.style.display = 'none';
            });
            
            // Show event cards (those with 'Evento' type or similar structure)
            const eventCards = document.querySelectorAll('[type="Evento"], [data-type="evento"]');
            eventCards.forEach(card => {
                card.style.display = 'block';
            });
        }

        function showGalleries() {
            document.querySelectorAll('#content-container > *').forEach(el => {
                el.style.display = 'none';
            });
            
            // Show gallery cards (those with 'Galería' type or similar structure)
            const galleryCards = document.querySelectorAll('[type="Galería"], [data-type="galeria"]');
            galleryCards.forEach(card => {
                card.style.display = 'block';
            });
        }
    </script>
@endsection
