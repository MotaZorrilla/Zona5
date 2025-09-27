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
        <div class="mx-auto max-w-6xl px-6 lg:px-8">
            <!-- Forum Header -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6 sm:mb-8">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-3 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl {{ $forum->color ? 'bg-[' . $forum->color . ']' : 'bg-primary-100' }} flex items-center justify-center flex-shrink-0">
                                <i class="{{ $forum->icon ?: 'ri-discuss-line' }} text-white text-lg sm:text-xl"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center gap-2 sm:gap-3 mb-2">
                                    <h1 class="text-xl sm:text-2xl font-bold text-gray-900 truncate">{{ $forum->title }}</h1>
                                    @if($forum->is_featured)
                                        <span class="px-2 py-1 bg-gradient-to-r from-orange-400 to-pink-400 text-white rounded-full text-xs font-medium flex-shrink-0">
                                            <i class="ri-star-line mr-1"></i>
                                            <span class="hidden sm:inline">Destacado</span>
                                        </span>
                                    @endif
                                </div>
                                <div class="flex flex-wrap items-center gap-2 sm:gap-4 text-xs sm:text-sm text-gray-500">
                                    <span class="flex items-center gap-1">
                                        <i class="ri-chat-1-line"></i>
                                        {{ $forum->posts_count }} publicaciones
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <i class="ri-eye-line"></i>
                                        {{ number_format($forum->views_count) }} vistas
                                    </span>
                                    @if($forum->last_activity_at)
                                        <span class="flex items-center gap-1">
                                            <i class="ri-time-line"></i>
                                            Activo {{ $forum->last_activity_at->diffForHumans() }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 sm:gap-3">
                            <a href="{{ route('public.forums') }}"
                               class="px-3 sm:px-4 py-2 border border-gray-300 text-gray-700 rounded-lg text-xs sm:text-sm font-medium hover:bg-gray-50 transition-colors">
                                <i class="ri-arrow-left-line mr-1 sm:mr-2"></i>
                                <span class="hidden sm:inline">Volver</span>
                                <span class="sm:hidden">Atrás</span>
                            </a>
                            @auth
                                <button id="subscribeBtn"
                                        class="px-3 sm:px-4 py-2 bg-primary-600 text-white rounded-lg text-xs sm:text-sm font-medium hover:bg-primary-700 transition-colors">
                                    <i class="ri-notification-line mr-1 sm:mr-2"></i>
                                    <span class="hidden sm:inline">Suscribirse</span>
                                    <span class="sm:hidden">Suscribir</span>
                                </button>
                            @endauth
                        </div>
                    </div>
                    @if($forum->description)
                        <div class="pt-3 sm:pt-4 border-t border-gray-200">
                            <p class="text-gray-600 leading-relaxed text-sm sm:text-base">{{ $forum->description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Toolbar -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-3 sm:p-4 mb-4 sm:mb-6">
                <div class="flex flex-col gap-3 sm:gap-0 sm:flex-row sm:items-center sm:justify-between">
                    <!-- Sort Options -->
                    <div class="flex items-center gap-2 sm:gap-3">
                        <span class="text-xs sm:text-sm font-medium text-gray-700">Ordenar por:</span>
                        <select id="sortSelect" class="px-2 sm:px-3 py-1.5 sm:py-2 border border-gray-300 rounded-lg text-xs sm:text-sm focus:outline-none focus:ring-2 focus:ring-primary-500">
                            <option value="recent">Más recientes</option>
                            <option value="popular">Más populares</option>
                            <option value="votes">Más votados</option>
                            <option value="featured">Destacados</option>
                        </select>
                    </div>

                    <!-- View Toggle -->
                    <div class="flex items-center gap-1 sm:gap-2">
                        <button id="listView" class="view-toggle active p-1.5 sm:p-2 bg-primary-100 text-primary-600 rounded-lg" title="Vista de lista">
                            <i class="ri-list-unordered text-sm sm:text-base"></i>
                        </button>
                        <button id="cardView" class="view-toggle p-1.5 sm:p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200" title="Vista de tarjetas">
                            <i class="ri-grid-line text-sm sm:text-base"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- New Post Form (for authenticated users) -->
            @auth
                <div id="newPostForm" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6 sm:mb-8">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-primary-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="ri-user-line text-primary-600 text-sm sm:text-base"></i>
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-semibold text-gray-900 text-sm sm:text-base">Crear nueva publicación</h3>
                            <p class="text-xs sm:text-sm text-gray-500">Comparte tus ideas con la comunidad</p>
                        </div>
                    </div>

                    <form action="{{ route('public.forums.store-post', $forum) }}" method="POST" class="space-y-3 sm:space-y-4">
                        @csrf
                        <div>
                            <input type="text"
                                   name="title"
                                   placeholder="Título de tu publicación..."
                                   required
                                   class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors text-sm sm:text-base">
                        </div>
                        <div>
                            <textarea name="content"
                                      rows="4 sm:rows-6"
                                      placeholder="Escribe el contenido de tu publicación aquí... Puedes usar Markdown para formatear."
                                      required
                                      class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-colors resize-none text-sm sm:text-base"></textarea>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div class="flex items-center gap-3">
                                <label class="flex items-center gap-2 text-xs sm:text-sm text-gray-600">
                                    <input type="checkbox" name="is_featured" class="rounded border-gray-300 text-primary-600 focus:ring-primary-500">
                                    <span>Destacar publicación</span>
                                </label>
                            </div>
                            <button type="submit"
                                    class="px-4 sm:px-6 py-2.5 sm:py-3 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors text-sm sm:text-base self-start sm:self-auto">
                                <i class="ri-send-plane-line mr-1 sm:mr-2"></i>
                                Publicar
                            </button>
                        </div>
                    </form>
                </div>
            @endauth

            <!-- Posts Container -->
            <div id="postsContainer" class="space-y-6">
                @forelse($posts as $post)
                    <div class="post-card bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-300"
                         data-post-id="{{ $post->id }}"
                         data-votes="{{ $post->likes_count - $post->dislikes_count }}"
                         data-featured="{{ $post->is_featured ? 'true' : 'false' }}">

                        <!-- Post Header -->
                        <div class="p-4 sm:p-6 pb-3 sm:pb-4">
                            <div class="flex items-start justify-between mb-3 sm:mb-4">
                                <div class="flex items-center gap-2 sm:gap-3 min-w-0 flex-1">
                                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white font-semibold text-sm sm:text-base flex-shrink-0">
                                        {{ substr($post->author->name ?? 'U', 0, 1) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div class="flex items-center gap-2 mb-1">
                                            <h4 class="font-semibold text-gray-900 text-sm sm:text-base truncate">{{ $post->author->name ?? 'Usuario Desconocido' }}</h4>
                                            @if($post->is_featured)
                                                <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 bg-gradient-to-r from-orange-400 to-pink-400 text-white rounded-full text-xs font-medium flex-shrink-0">
                                                    <i class="ri-star-line mr-1 text-xs"></i>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="flex items-center gap-2 text-xs sm:text-sm text-gray-500">
                                            <span>{{ $post->created_at->diffForHumans() }}</span>
                                            @if($post->is_pinned)
                                                <span class="flex items-center gap-1">
                                                    <i class="ri-pushpin-line text-xs"></i>
                                                    <span class="hidden sm:inline">Pineado</span>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1 sm:gap-2 flex-shrink-0">
                                    @auth
                                        <button class="post-action-btn p-1.5 sm:p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100"
                                                title="Compartir">
                                            <i class="ri-share-line text-sm sm:text-base"></i>
                                        </button>
                                    @endauth
                                </div>
                            </div>

                            <!-- Post Content -->
                            <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 sm:mb-3 leading-tight">{{ $post->title }}</h3>
                            <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed mb-3 sm:mb-4 text-sm sm:text-base">
                                {{ $post->content }}
                            </div>

                            <!-- Post Actions -->
                            <div class="flex items-center justify-between pt-3 sm:pt-4 border-t border-gray-200">
                                <div class="flex items-center gap-3 sm:gap-6">
                                    <!-- Voting System -->
                                    @auth
                                        <div class="flex items-center gap-1 sm:gap-2">
                                            <button class="vote-btn like-btn p-1.5 sm:p-2 rounded-lg transition-all duration-200 {{ $post->hasUserLiked(auth()->id()) ? 'bg-green-100 text-green-600' : 'text-gray-400 hover:bg-gray-100 hover:text-green-600' }}"
                                                    data-post-id="{{ $post->id }}"
                                                    data-vote-type="like"
                                                    title="Me gusta">
                                                <i class="ri-thumb-up-line text-base sm:text-lg"></i>
                                            </button>
                                            <span class="vote-count min-w-[2rem] sm:min-w-[3rem] text-center font-semibold text-xs sm:text-sm {{ ($post->likes_count - $post->dislikes_count) > 0 ? 'text-green-600' : (($post->likes_count - $post->dislikes_count) < 0 ? 'text-red-600' : 'text-gray-500') }}">
                                                {{ $post->likes_count - $post->dislikes_count }}
                                            </span>
                                            <button class="vote-btn dislike-btn p-1.5 sm:p-2 rounded-lg transition-all duration-200 {{ $post->hasUserDisliked(auth()->id()) ? 'bg-red-100 text-red-600' : 'text-gray-400 hover:bg-gray-100 hover:text-red-600' }}"
                                                    data-post-id="{{ $post->id }}"
                                                    data-vote-type="dislike"
                                                    title="No me gusta">
                                                <i class="ri-thumb-down-line text-base sm:text-lg"></i>
                                            </button>
                                        </div>
                                    @else
                                        <div class="flex items-center gap-2 text-gray-500 text-xs sm:text-sm">
                                            <span class="flex items-center gap-1">
                                                <i class="ri-thumb-up-line"></i>
                                                {{ $post->likes_count }}
                                            </span>
                                            <span class="flex items-center gap-1">
                                                <i class="ri-thumb-down-line"></i>
                                                {{ $post->dislikes_count }}
                                            </span>
                                        </div>
                                    @endauth

                                    <!-- Comments -->
                                    <button class="flex items-center gap-1 sm:gap-2 text-gray-500 hover:text-gray-700 transition-colors text-xs sm:text-sm">
                                        <i class="ri-chat-1-line"></i>
                                        <span>{{ $post->repliesCount() }}</span>
                                    </button>

                                    <!-- Views -->
                                    <span class="flex items-center gap-1 text-gray-500 text-xs sm:text-sm">
                                        <i class="ri-eye-line"></i>
                                        {{ number_format($post->views_count) }}
                                    </span>
                                </div>

                                @auth
                                    <div class="flex items-center gap-2">
                                        <button class="reply-btn px-3 sm:px-4 py-1.5 sm:py-2 bg-gray-100 text-gray-700 rounded-lg text-xs sm:text-sm font-medium hover:bg-gray-200 transition-colors">
                                            <i class="ri-reply-line mr-1 sm:mr-2"></i>
                                            <span class="hidden sm:inline">Responder</span>
                                            <span class="sm:hidden">Reply</span>
                                        </button>
                                    </div>
                                @endauth
                            </div>
                        </div>

                        <!-- Replies Section -->
                        @if($post->hasReplies())
                            <div class="border-t border-gray-200 bg-gray-50/50">
                                <div class="p-6">
                                    <h4 class="font-semibold text-gray-900 mb-4">{{ $post->repliesCount() }} respuestas</h4>
                                    <div class="space-y-4">
                                        @foreach($post->replies as $reply)
                                            <div class="bg-white rounded-xl border border-gray-200 p-4">
                                                <div class="flex items-start gap-3">
                                                    <div class="w-8 h-8 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full flex items-center justify-center text-white text-sm font-semibold flex-shrink-0">
                                                        {{ substr($reply->author->name ?? 'U', 0, 1) }}
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="flex items-center gap-2 mb-2">
                                                            <span class="font-medium text-gray-900">{{ $reply->author->name ?? 'Usuario Desconocido' }}</span>
                                                            <span class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <div class="text-gray-700 leading-relaxed">{{ $reply->content }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="mx-auto max-w-md">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <i class="ri-chat-1-line text-4xl text-gray-400"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">No hay publicaciones aún</h3>
                            <p class="text-gray-500 mb-6">Este foro aún no tiene publicaciones. ¡Sé el primero en iniciar una conversación!</p>
                            @auth
                                <button onclick="document.querySelector('#newPostForm form').scrollIntoView({behavior: 'smooth'})"
                                        class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-medium rounded-xl hover:bg-primary-700 transition-colors">
                                    <i class="ri-add-line mr-2"></i>
                                    Crear primera publicación
                                </button>
                            @else
                                <div class="text-sm text-gray-400">
                                    <p class="mb-2">Inicia sesión para participar en las discusiones.</p>
                                    <a href="{{ route('login') }}" class="text-primary-600 hover:text-primary-700 font-medium">
                                        Iniciar sesión
                                    </a>
                                </div>
                            @endauth
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($posts->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Enhanced JavaScript -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Voting System
            const voteButtons = document.querySelectorAll('.vote-btn');

            voteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    @auth
                        const postId = this.dataset.postId;
                        const voteType = this.dataset.voteType;

                        fetch(`/forums/${postId}/vote`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                            },
                            body: JSON.stringify({ vote_type: voteType })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update vote counts and button states
                                const postCard = document.querySelector(`[data-post-id="${postId}"]`);
                                const voteCount = postCard.querySelector('.vote-count');
                                const likeBtn = postCard.querySelector('.like-btn');
                                const dislikeBtn = postCard.querySelector('.dislike-btn');

                                voteCount.textContent = data.votes;
                                voteCount.className = `vote-count min-w-[3rem] text-center font-semibold ${data.votes > 0 ? 'text-green-600' : (data.votes < 0 ? 'text-red-600' : 'text-gray-500')}`;

                                // Update button states
                                likeBtn.className = `vote-btn like-btn p-2 rounded-lg transition-all duration-200 ${data.user_vote === 'like' ? 'bg-green-100 text-green-600' : 'text-gray-400 hover:bg-gray-100 hover:text-green-600'}`;
                                dislikeBtn.className = `vote-btn dislike-btn p-2 rounded-lg transition-all duration-200 ${data.user_vote === 'dislike' ? 'bg-red-100 text-red-600' : 'text-gray-400 hover:bg-gray-100 hover:text-red-600'}`;
                            }
                        })
                        .catch(error => console.error('Error:', error));
                    @else
                        // Redirect to login
                        window.location.href = "{{ route('login') }}";
                    @endauth
                });
            });

            // Sort functionality
            const sortSelect = document.getElementById('sortSelect');
            if (sortSelect) {
                sortSelect.addEventListener('change', function() {
                    const sortValue = this.value;
                    const postsContainer = document.getElementById('postsContainer');
                    const postCards = Array.from(postsContainer.querySelectorAll('.post-card'));

                    postCards.sort((a, b) => {
                        switch(sortValue) {
                            case 'popular':
                                return parseInt(b.dataset.votes) - parseInt(a.dataset.votes);
                            case 'featured':
                                if (a.dataset.featured === 'true' && b.dataset.featured !== 'true') return -1;
                                if (b.dataset.featured === 'true' && a.dataset.featured !== 'true') return 1;
                                return 0;
                            default:
                                return 0; // Keep original order for recent
                        }
                    });

                    postCards.forEach(card => postsContainer.appendChild(card));
                });
            }

            // View toggle functionality
            const listView = document.getElementById('listView');
            const cardView = document.getElementById('cardView');
            const postsContainer = document.getElementById('postsContainer');

            if (listView && cardView) {
                listView.addEventListener('click', function() {
                    postsContainer.className = 'space-y-4';
                    this.className = 'view-toggle active p-2 bg-primary-100 text-primary-600 rounded-lg';
                    cardView.className = 'view-toggle p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200';
                });

                cardView.addEventListener('click', function() {
                    postsContainer.className = 'space-y-6';
                    this.className = 'view-toggle active p-2 bg-primary-100 text-primary-600 rounded-lg';
                    listView.className = 'view-toggle p-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200';
                });
            }

            // Reply functionality
            const replyButtons = document.querySelectorAll('.reply-btn');
            replyButtons.forEach(button => {
                button.addEventListener('click', function() {
                    @auth
                        // Scroll to new post form
                        document.querySelector('#newPostForm form').scrollIntoView({behavior: 'smooth'});
                        // You could also pre-fill a parent_id here
                    @else
                        window.location.href = "{{ route('login') }}";
                    @endauth
                });
            });

            // Animate posts on scroll
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

            document.querySelectorAll('.post-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(card);
            });
        });
    </script>
    @endpush
@endsection