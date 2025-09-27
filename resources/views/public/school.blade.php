@extends('layouts.public')

@section('title', 'Escuela Virtual - Gran Zona 5')

@section('content')
    <div>
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-r from-primary-800 to-blue-900">
            <div class="absolute inset-0">
                <img class="w-full h-full object-cover opacity-30" src="https://picsum.photos/seed/school-hero/1920/1080" alt="Escuela Virtual de la Gran Zona 5">
                <div class="absolute inset-0 bg-primary-800 mix-blend-multiply" aria-hidden="true"></div>
            </div>
            <div class="relative max-w-4xl mx-auto text-center py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
                <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl font-serif">Escuela Virtual de la Zona 5</h1>
                <p class="mt-6 text-xl text-primary-100">Fomentando la luz del conocimiento a través de la formación continua, síncrona y asíncrona.</p>
                @guest
                    <p class="mt-8 text-white text-lg">Para acceder a los cursos, por favor <a href="{{ route('login') }}" class="underline font-semibold hover:text-primary-200" wire:navigate>inicia sesión</a> o <a href="{{ route('register') }}" class="underline font-semibold hover:text-primary-200" wire:navigate>regístrate</a>.</p>
                @endguest
                @auth
                    <a href="#" target="_blank" class="mt-8 w-full inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-md text-primary-600 bg-white hover:bg-primary-50 sm:w-auto cta-button">
                        Acceder al Campus Virtual <i class="ri-external-link-line ml-2"></i>
                    </a>
                @endauth
            </div>
        </div>

        <!-- Main Content -->
        <div class="py-16 sm:py-24 lg:py-32 bg-gradient-to-b from-primary-50 to-blue-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Upcoming Live Classes -->
                <div class="text-center" data-scroll-reveal>
                    <h2 class="text-3xl font-extrabold text-primary-600 sm:text-4xl font-serif">Próximas Clases en Vivo</h2>
                    <p class="mt-4 text-lg text-gray-500">Participa en nuestras sesiones interactivas y comparte en tiempo real con instructores y hermanos.</p>
                </div>

                <!-- Live Classes Slider -->
                <div class="mt-12 relative">
                    <div class="overflow-hidden" id="live-classes-slider">
                        <div class="flex transition-transform duration-300 ease-in-out" id="slider-track">
                            @forelse($upcomingSessions as $session)
                                <div class="w-full md:w-1/2 lg:w-1/3 flex-shrink-0 px-4">
                                    <x-card-event
                                        :image="$session->course->image_url ?? 'https://picsum.photos/seed/event-' . $loop->index . '/800/600'"
                                        :title="$session->title ?? $session->course->title"
                                        :subtitle="$session->description ?? $session->course->subtitle"
                                        :date="$session->start_time->format('Y-m-d')"
                                        :time="$session->start_time->format('H:i')"
                                        :instructorName="$session->instructor_name ?? $session->course->instructor_name"
                                        :instructorRole="$session->instructor_role ?? $session->course->instructor_role"
                                        :instructorImage="$session->instructor_image ?? $session->course->instructor_image"
                                        :status="$session->status"
                                        :link="$session->link ?? '#'"
                                    />
                                </div>
                            @empty
                                <div class="w-full text-center py-12">
                                    <i class="ri-calendar-todo-line text-6xl text-gray-300 mb-4"></i>
                                    <h3 class="text-xl font-medium text-gray-500 mb-2">No hay clases programadas</h3>
                                    <p class="text-gray-400">Próximamente anunciaremos nuevas sesiones en vivo.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    @if($upcomingSessions->count() > 3)
                        <button id="prev-btn" class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-primary-600 hover:bg-primary-700 text-white p-2 rounded-full shadow-lg z-10 transition-colors duration-200">
                            <i class="ri-arrow-left-s-line text-xl"></i>
                        </button>
                        <button id="next-btn" class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-primary-600 hover:bg-primary-700 text-white p-2 rounded-full shadow-lg z-10 transition-colors duration-200">
                            <i class="ri-arrow-right-s-line text-xl"></i>
                        </button>

                        <!-- Dots Indicator -->
                        <div class="flex justify-center mt-6 space-x-2" id="slider-dots">
                            @for($i = 0; $i < ceil($upcomingSessions->count() / 3); $i++)
                                <button class="slider-dot w-3 h-3 rounded-full transition-colors duration-200 {{ $i === 0 ? 'bg-primary-600' : 'bg-gray-300' }}" data-slide="{{ $i }}"></button>
                            @endfor
                        </div>
                    @endif
                </div>

                <!-- Asynchronous Courses -->
                <div class="mt-24 text-center" data-scroll-reveal>
                    <h2 class="text-3xl font-extrabold text-primary-600 sm:text-4xl font-serif">Catálogo de Cursos</h2>
                    <p class="mt-4 text-lg text-gray-500">Aprende a tu propio ritmo con nuestra biblioteca de cursos disponibles 24/7.</p>
                </div>
                <div class="mt-12 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    @forelse($asynchronousCourses as $course)
                        <x-card-course 
                            :image="$course->image_url ?? 'https://picsum.photos/seed/course-' . $loop->index . '/800/600'" 
                            :title="$course->title" 
                            :subtitle="$course->subtitle" 
                            :grade="$course->grade_level" 
                            :link="$course->link ?? '#'"
                        />
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <i class="ri-book-open-line text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-medium text-gray-500 mb-2">No hay cursos disponibles</h3>
                            <p class="text-gray-400">Estamos trabajando en nuevos contenidos para nuestra escuela virtual.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Live Classes Slider JavaScript -->
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if($upcomingSessions->count() > 3)
                const slider = document.getElementById('live-classes-slider');
                const track = document.getElementById('slider-track');
                const prevBtn = document.getElementById('prev-btn');
                const nextBtn = document.getElementById('next-btn');
                const dots = document.querySelectorAll('.slider-dot');

                let currentSlide = 0;
                const totalSlides = Math.ceil({{ $upcomingSessions->count() }} / 3);
                const slideWidth = slider.offsetWidth;

                function updateSlider() {
                    const translateX = -currentSlide * slideWidth;
                    track.style.transform = `translateX(${translateX}px)`;

                    // Update dots
                    dots.forEach((dot, index) => {
                        if (index === currentSlide) {
                            dot.classList.remove('bg-gray-300');
                            dot.classList.add('bg-primary-600');
                        } else {
                            dot.classList.remove('bg-primary-600');
                            dot.classList.add('bg-gray-300');
                        }
                    });
                }

                nextBtn.addEventListener('click', function() {
                    if (currentSlide < totalSlides - 1) {
                        currentSlide++;
                        updateSlider();
                    }
                });

                prevBtn.addEventListener('click', function() {
                    if (currentSlide > 0) {
                        currentSlide--;
                        updateSlider();
                    }
                });

                dots.forEach((dot, index) => {
                    dot.addEventListener('click', function() {
                        currentSlide = index;
                        updateSlider();
                    });
                });

                // Handle window resize
                window.addEventListener('resize', function() {
                    updateSlider();
                });
            @endif
        });
    </script>
    @endpush
@endsection
