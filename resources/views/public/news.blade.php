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
            <div class="mb-12 flex justify-center space-x-2 sm:space-x-4" id="filter-buttons" data-scroll-reveal>
                <button class="px-4 py-2 text-sm font-medium rounded-md filter-btn active" data-filter="all">Todos</button>
                <button class="px-4 py-2 text-sm font-medium rounded-md filter-btn" data-filter="noticia">Noticias</button>
                <button class="px-4 py-2 text-sm font-medium rounded-md filter-btn" data-filter="evento">Eventos</button>
            </div>

            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3" data-scroll-reveal id="content-container">
                @forelse($news as $item)
                    <div data-category="noticia">
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
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12">
                        <p class="text-gray-500 text-lg">No hay noticias publicadas en este momento.</p>
                    </div>
                @endforelse

                @foreach($events as $event)
                    <div data-category="evento">
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
                    </div>
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

    <style>
        .filter-btn {
            background-color: #f3f4f6; /* gray-100 */
            color: #374151; /* gray-700 */
            transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
        }
        .filter-btn.active {
            background-color: #1E3A8A; /* primary-dark */
            color: #ffffff;
        }
        .filter-btn:hover {
            background-color: #d1d5db; /* gray-300 */
        }
        .filter-btn.active:hover {
            background-color: #1c347a;
        }

        [data-category] {
            transition: opacity 500ms ease-in-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const filterButtonsContainer = document.getElementById('filter-buttons');
            const contentContainer = document.getElementById('content-container');
            const items = contentContainer.querySelectorAll('[data-category]');
            const transitionDuration = 500; // Must match CSS transition duration

            filterButtonsContainer.addEventListener('click', function (event) {
                const target = event.target;
                if (!target.matches('.filter-btn') || filterButtonsContainer.classList.contains('is-filtering')) {
                    return;
                }
                
                filterButtonsContainer.classList.add('is-filtering');

                // Update active button
                filterButtonsContainer.querySelector('.active').classList.remove('active');
                target.classList.add('active');

                // 1. Fade out all visible items
                let itemsToFade = [];
                items.forEach(item => {
                    if (item.style.display !== 'none') {
                        itemsToFade.push(item);
                        item.style.opacity = '0';
                    }
                });

                // 2. After fade-out, hide them and then show the new set
                setTimeout(() => {
                    const filter = target.getAttribute('data-filter');

                    // Hide all items that were faded out
                    itemsToFade.forEach(item => item.style.display = 'none');

                    // Prepare items to be shown
                    let itemsToShow = [];
                    items.forEach(item => {
                        const shouldShow = (filter === 'all' || item.getAttribute('data-category') === filter);
                        if (shouldShow) {
                            itemsToShow.push(item);
                            item.style.opacity = '0'; // Ensure it starts transparent
                            item.style.display = 'block';
                        }
                    });

                    // 3. In the next frame, fade in the new set
                    requestAnimationFrame(() => {
                        itemsToShow.forEach(item => {
                            item.style.opacity = '1';
                        });
                    });

                    filterButtonsContainer.classList.remove('is-filtering');
                }, transitionDuration);
            });
        });
    </script>
@endsection