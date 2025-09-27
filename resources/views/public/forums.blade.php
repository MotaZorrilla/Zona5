@extends('layouts.public')

@section('title', $pageSettings['title'] . ' - Gran Zona 5')

@section('content')
    <x-public.hero
        title="{{ $pageSettings['title'] }}"
        subtitle="{{ $pageSettings['subtitle'] }}"
        imageUrl="{{ $pageSettings['banner_image'] }}"
    />

    <!-- Enhanced Forum Container -->
    <div class="py-12 sm:py-16">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <!-- Forum Header with Search and Filters -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6 sm:mb-8">
                <div class="flex flex-col gap-4">
                    <!-- Search Bar -->
                    <div class="relative">
                        <label for="forumSearch" class="sr-only">Buscar foros</label>
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="ri-search-line text-gray-400" aria-hidden="true"></i>
                        </div>
                        <input type="text"
                               id="forumSearch"
                               placeholder="Buscar foros..."
                               aria-label="Buscar foros"
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-colors duration-200 text-base">
                    </div>

                    <!-- Filter Tabs -->
                    <div class="flex items-center gap-2 overflow-x-auto pb-2" role="tablist" aria-label="Filtros de foros">
                        <button data-filter="all"
                                class="filter-btn active px-3 sm:px-4 py-2 bg-primary-600 text-white rounded-lg text-sm font-medium whitespace-nowrap"
                                role="tab"
                                aria-selected="true"
                                aria-controls="forums-container">
                            Todos
                        </button>
                        <button data-filter="featured"
                                class="filter-btn px-3 sm:px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors whitespace-nowrap"
                                role="tab"
                                aria-selected="false"
                                aria-controls="forums-container">
                            Destacados
                        </button>
                        <button data-filter="popular"
                                class="filter-btn px-3 sm:px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors whitespace-nowrap"
                                role="tab"
                                aria-selected="false"
                                aria-controls="forums-container">
                            Populares
                        </button>
                        <button data-filter="recent"
                                class="filter-btn px-3 sm:px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors whitespace-nowrap"
                                role="tab"
                                aria-selected="false"
                                aria-controls="forums-container">
                            Recientes
                        </button>
                    </div>
                </div>
            </div>

            <!-- Category Navigation -->
            @if($categories->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Categorías</h3>
                    <div class="flex flex-wrap gap-3" role="group" aria-label="Categorías de foros">
                        <button data-category="all"
                                class="category-btn active px-4 py-2 bg-primary-100 text-primary-800 rounded-full text-sm font-medium hover:bg-primary-200 transition-colors"
                                aria-pressed="true">
                            Todas las categorías
                        </button>
                        @foreach($categories as $category)
                            <button data-category="{{ $category }}"
                                    class="category-btn px-4 py-2 bg-gray-100 text-gray-700 rounded-full text-sm font-medium hover:bg-gray-200 transition-colors"
                                    aria-pressed="false">
                                {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Forums Grid -->
            <div id="forumsContainer"
                 class="grid grid-cols-1 gap-4 sm:gap-6 lg:grid-cols-2 xl:grid-cols-3"
                 data-scroll-reveal
                 role="main"
                 aria-label="Lista de foros">
                @forelse($forums as $forum)
                    <div class="forum-card bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:border-primary-200 transition-all duration-300"
                         data-category="{{ $forum->category }}"
                         data-featured="{{ $forum->is_featured ? 'true' : 'false' }}"
                         data-popular="{{ $forum->views_count > 50 ? 'true' : 'false' }}"
                         role="article"
                         aria-labelledby="forum-title-{{ $forum->id }}">

                        <!-- Forum Header -->
                        <div class="p-4 sm:p-6 pb-3 sm:pb-4">
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3 flex-1 min-w-0">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl {{ $forum->color ? 'bg-[' . $forum->color . ']' : 'bg-primary-100' }} flex items-center justify-center flex-shrink-0">
                                        <i class="{{ $forum->icon ?: 'ri-discuss-line' }} text-white text-sm sm:text-base"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 id="forum-title-{{ $forum->id }}" class="font-bold text-gray-900 text-base sm:text-lg leading-tight mb-1 truncate">{{ $forum->title }}</h3>
                                        @if($forum->category)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-primary-100 text-primary-800">
                                                {{ $forum->category }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-1 sm:gap-2 ml-2 flex-shrink-0">
                                    @if($forum->is_pinned)
                                        <span class="px-1.5 sm:px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">
                                            <i class="ri-pushpin-line mr-1"></i>
                                            <span class="hidden sm:inline">Pineado</span>
                                        </span>
                                    @endif
                                    @if($forum->is_featured)
                                        <span class="px-1.5 sm:px-2 py-1 bg-gradient-to-r from-orange-400 to-pink-400 text-white rounded-full text-xs font-medium">
                                            <i class="ri-star-line mr-1"></i>
                                            <span class="hidden sm:inline">Destacado</span>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            @if($forum->excerpt || $forum->description)
                                <p class="text-gray-600 text-xs sm:text-sm leading-relaxed mb-3 sm:mb-4 line-clamp-2">
                                    {{ $forum->excerpt ?: Str::limit($forum->description, 120) }}
                                </p>
                            @endif
                        </div>

                        <!-- Forum Stats -->
                        <div class="px-4 sm:px-6 pb-3 sm:pb-4">
                            <div class="flex items-center justify-between text-xs sm:text-sm text-gray-500">
                                <div class="flex items-center gap-3 sm:gap-4">
                                    <span class="flex items-center gap-1">
                                        <i class="ri-chat-1-line"></i>
                                        {{ $forum->posts_count }} posts
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="ri-eye-line"></i>
                                        {{ number_format($forum->views_count) }} vistas
                                    </span>
                                </div>
                                @if($forum->latestPost)
                                    <span class="text-xs hidden sm:block">
                                        {{ $forum->latestPost->created_at->diffForHumans() }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Forum Footer -->
                        <div class="px-4 sm:px-6 pb-4 sm:pb-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2 text-xs text-gray-400">
                                    @if($forum->creator)
                                        <span class="hidden sm:inline">por {{ $forum->creator->name }}</span>
                                    @endif
                                    @if($forum->last_activity_at)
                                        <span class="hidden sm:inline">•</span>
                                        <span>Activo {{ $forum->last_activity_at->diffForHumans() }}</span>
                                    @endif
                                </div>
                                <a href="{{ route('public.forums.show', $forum) }}"
                                   class="inline-flex items-center px-3 sm:px-4 py-2 bg-primary-600 text-white text-xs sm:text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200"
                                   aria-label="Ver foro {{ $forum->title }}">
                                    <span class="hidden sm:inline">Explorar</span>
                                    <span class="sm:hidden">Ver</span>
                                    <i class="ri-arrow-right-line ml-1 sm:ml-2" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="col-span-full text-center py-16">
                        <div class="mx-auto max-w-md">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="ri-discuss-line text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay foros disponibles</h3>
                            <p class="text-gray-500 mb-6">Los foros de discusión estarán disponibles próximamente. ¡Sé el primero en crear uno!</p>
                            @auth
                                <a href="#" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition-colors">
                                    <i class="ri-add-line mr-2"></i>
                                    Crear Foro
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($forums->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $forums->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Forum Search Functionality
            const searchInput = document.getElementById('forumSearch');
            const forumCards = document.querySelectorAll('.forum-card');
            const filterButtons = document.querySelectorAll('.filter-btn');
            const categoryButtons = document.querySelectorAll('.category-btn');

            // Search functionality
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();

                    forumCards.forEach(card => {
                        const title = card.querySelector('h3').textContent.toLowerCase();
                        const description = card.querySelector('p')?.textContent.toLowerCase() || '';
                        const category = card.dataset.category?.toLowerCase() || '';

                        if (title.includes(searchTerm) || description.includes(searchTerm) || category.includes(searchTerm)) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            }

            // Filter functionality
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const filter = this.dataset.filter;

                    // Update active button
                    filterButtons.forEach(btn => btn.classList.remove('active', 'bg-primary-600', 'text-white'));
                    this.classList.add('active', 'bg-primary-600', 'text-white');

                    // Filter cards
                    forumCards.forEach(card => {
                        switch(filter) {
                            case 'featured':
                                card.style.display = card.dataset.featured === 'true' ? 'block' : 'none';
                                break;
                            case 'popular':
                                card.style.display = card.dataset.popular === 'true' ? 'block' : 'none';
                                break;
                            case 'recent':
                                // Show all for recent (you might want to implement actual date filtering)
                                card.style.display = 'block';
                                break;
                            default:
                                card.style.display = 'block';
                        }
                    });
                });
            });

            // Category filter functionality
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.dataset.category;

                    // Update active button
                    categoryButtons.forEach(btn => btn.classList.remove('active', 'bg-primary-100', 'text-primary-800'));
                    this.classList.add('active', 'bg-primary-100', 'text-primary-800');

                    // Filter cards
                    forumCards.forEach(card => {
                        if (category === 'all' || card.dataset.category === category) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });

            // Animate forum cards on scroll
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            forumCards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
    @endpush
@endsection
