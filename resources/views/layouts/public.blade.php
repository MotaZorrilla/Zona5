<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gran Zona 5')</title>

    <x-favicon-link />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Merriweather:wght@400;700;900&display=swap" rel="stylesheet">

    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        :root {
            --primary-color: #2C3E50; /* Masonic Blue */
            --primary-hover: #34495E; /* Lighter Masonic Blue */
            --secondary-color: #EC4899; /* Pink 500 */
            --light-bg: #F9FAFB; /* Gray 50 */
            --font-sans: 'Inter', sans-serif;
            --font-serif: 'Merriweather', serif;
        }
        body {
            font-family: var(--font-sans);
            background-color: white;
            color: #374151; /* Gray 700 */
        }
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: var(--font-serif);
        }
        .cta-button {
            transition: all 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3), 0 4px 6px -2px rgba(99, 102, 241, 0.2);
        }
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header x-data="{ open: false, scrolled: false, lastScrollY: 0, scrollingUp: false, scrollingDown: false }"
        x-on:scroll.window="
            scrolled = (window.scrollY > 0);
            scrollingUp = (window.scrollY < lastScrollY && window.scrollY > 0);
            scrollingDown = (window.scrollY > lastScrollY && window.scrollY > 0);
            lastScrollY = window.scrollY;
        "
        :class="{
            'bg-gray-800 shadow-md': scrolled || scrollingUp,
            'transform -translate-y-full opacity-0': scrollingDown
        }"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300 ease-in-out"
    >
        <div class="relative max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <nav class="w-full flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('welcome') }}" class="flex items-center">
                        <x-application-logo class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-primary-500 text-xl font-bold" />
                        <span class="ml-3 text-2xl font-bold text-white">Gran Zona 5</span>
                    </a>
                </div>

                <!-- Main Navigation and Login/Register (Desktop) -->
                <div class="hidden md:flex flex-grow justify-center">
                    <!-- Desktop Menu -->
                    <div class="flex items-center space-x-8">
                        <a href="{{ route('welcome') }}" class="text-base font-medium text-white hover:text-primary-200">Inicio</a>
                        <a href="{{ route('public.about-us') }}" class="text-base font-medium text-white hover:text-primary-200">Quiénes Somos</a>
                        <a href="{{ route('public.lodges') }}" class="text-base font-medium text-white hover:text-primary-200">Logias</a>

                        <!-- Dropdown "Recursos" -->
                        <div x-data="{ dropdownOpen: false }" class="relative">
                            <button @click="dropdownOpen = !dropdownOpen" @click.away="dropdownOpen = false" class="flex items-center text-base font-medium text-white hover:text-primary-200 focus:outline-none">
                                <span>Recursos</span>
                                <i class="ri-arrow-down-s-line ml-1"></i>
                            </button>
                            <div x-show="dropdownOpen" x-transition class="absolute mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 z-10">
                                <a href="{{ route('public.school') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Escuela Virtual</a>
                                <a href="{{ route('public.forums') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Foros</a>
                                <a href="{{ route('public.archive') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Archivo</a>
                            </div>
                        </div>

                        <a href="{{ route('public.news') }}" class="text-base font-medium text-white hover:text-primary-200">Actualidad</a>
                        <a href="{{ route('public.contact') }}" class="text-base font-medium text-white hover:text-primary-200">Contacto</a>
                    </div>

                    <!-- Login/Register Buttons (Desktop) -->
                    <div class="ml-8"> {{-- Added ml-8 for spacing --}}
                        @if (Route::has('login'))
                            <livewire:welcome.navigation />
                        @endif
                    </div>
                </div>

                <!-- Hamburger Button (Mobile) -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-primary-200 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="sr-only">Abrir menú principal</span>
                        <i x-show="!open" class="ri-menu-line h-6 w-6" aria-hidden="true"></i>
                        <i x-show="open" class="ri-close-line h-6 w-6" aria-hidden="true"></i>
                    </button>
                </div>
            </nav>
        </div>

        <!-- Mobile Menu Panel -->
        <div x-show="open" x-transition:enter="duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-100 ease-in" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden z-40">
            <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white divide-y-2 divide-gray-50">
                <div class="pt-5 pb-6 px-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <a href="{{ route('welcome') }}" class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-primary-500 flex items-center justify-center text-white text-xl font-bold">Z5</div>
                                <span class="ml-3 text-2xl font-bold text-gray-900">Gran Zona 5</span>
                            </a>
                        </div>
                        <div class="-mr-2">
                            <button @click="open = false" type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500">
                                <span class="sr-only">Cerrar menú</span>
                                <i class="ri-close-line h-6 w-6" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mt-6">
                        <nav class="grid gap-y-8">
                            <a href="{{ route('welcome') }}" class="flex items-center p-3 -m-3 rounded-md hover:bg-gray-50">
                                <span class="ml-3 text-base font-medium text-gray-900">Inicio</span>
                            </a>
                            <a href="{{ route('public.about-us') }}" class="flex items-center p-3 -m-3 rounded-md hover:bg-gray-50">
                                <span class="ml-3 text-base font-medium text-gray-900">Quiénes Somos</span>
                            </a>
                            <a href="{{ route('public.lodges') }}" class="flex items-center p-3 -m-3 rounded-md hover:bg-gray-50">
                                <span class="ml-3 text-base font-medium text-gray-900">Logias</span>
                            </a>
                            <div>
                                <h3 class="text-sm font-semibold text-gray-500 tracking-wider uppercase ml-3">Recursos</h3>
                                <div class="mt-4 space-y-4">
                                    <a href="{{ route('public.school') }}" class="flex items-center p-3 -m-3 rounded-md hover:bg-gray-50">
                                        <span class="ml-3 text-base font-medium text-gray-900">Escuela Virtual</span>
                                    </a>
                                    <a href="{{ route('public.forums') }}" class="flex items-center p-3 -m-3 rounded-md hover:bg-gray-50">
                                        <span class="ml-3 text-base font-medium text-gray-900">Foros</span>
                                    </a>
                                    <a href="{{ route('public.archive') }}" class="flex items-center p-3 -m-3 rounded-md hover:bg-gray-50">
                                        <span class="ml-3 text-base font-medium text-gray-900">Archivo</span>
                                    </a>
                                </div>
                            </div>
                            <a href="{{ route('public.news') }}" class="flex items-center p-3 -m-3 rounded-md hover:bg-gray-50">
                                <span class="ml-3 text-base font-medium text-gray-900">Actualidad</span>
                            </a>
                            <a href="{{ route('public.contact') }}" class="flex items-center p-3 -m-3 rounded-md hover:bg-gray-50">
                                <span class="ml-3 text-base font-medium text-gray-900">Contacto</span>
                            </a>
                        </nav>
                    </div>
                </div>
                <div class="py-6 px-5 space-y-6">
                    <div class="prose-lg">
                        @if (Route::has('login'))
                            <livewire:welcome.navigation />
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <!-- Example of Reveal on Scroll Effect -->
        <!-- To apply this effect to other sections, wrap them in a similar div with x-data, x-intersect.once, x-show, and x-transition attributes. -->
        <div x-data="{ show: false }"
             x-intersect.once="show = true"
             x-show="show"
             x-transition:enter="transition ease-out duration-1000"
             x-transition:enter-start="opacity-0 transform translate-y-10"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             class="py-16 bg-gray-100 text-center"
        >
            <h2 class="text-3xl font-bold text-gray-800">¡Bienvenido a nuestra sección interactiva!</h2>
            <p class="mt-4 text-lg text-gray-600">Este contenido aparece al hacer scroll.</p>
        </div>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                <!-- Logo and Copyright -->
                <div class="space-y-4 md:col-span-1">
                    <a href="{{ route('welcome') }}" class="inline-flex items-center justify-center md:justify-start">
                        <x-application-logo class="w-10 h-10 rounded-full flex items-center justify-center text-white text-xl font-bold" />
                        <span class="ml-3 text-2xl font-bold text-white">Gran Zona 5</span>
                    </a>
                    <p class="text-sm text-gray-400">
                        &copy; {{ date('Y') }} Gran Zona 5.<br>
                        Todos los derechos reservados.<br>
                        Jurisdiccionada a la<br>
                        <a href="https://www.granlogiadevenezuela.com" target="_blank" class="text-primary-400 hover:text-white transition-colors">Gran Logia de la República de Venezuela</a>
                    </p>
                    <p class="text-sm text-gray-500">
                        Desarrollado por <a href="https://motazorrilla.com" target="_blank" rel="noopener noreferrer" class="font-semibold text-primary-400 hover:text-white transition-colors">@MotaZorrilla</a>
                    </p>
                </div>

                <!-- Links -->
                <div class="md:col-span-1">
                    <h3 class="text-sm font-semibold tracking-wider uppercase text-white">Enlaces Útiles</h3>
                    <ul class="mt-4 space-y-2 pl-4">
                        <li><a href="{{ route('public.sitemap') }}" class="text-base text-gray-300 hover:text-white transition-colors">Mapa del Sitio</a></li>
                        <li><a href="{{ route('public.faq') }}" class="text-base text-gray-300 hover:text-white transition-colors">Preguntas Frecuentes</a></li>
                        <li><a href="{{ route('privacy-policy') }}" class="text-base text-gray-300 hover:text-white transition-colors">Política de Privacidad</a></li>
                        <li><a href="{{ route('terms-of-service') }}" class="text-base text-gray-300 hover:text-white transition-colors">Términos de Servicio</a></li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div class="md:col-span-1">
                    <h3 class="text-sm font-semibold tracking-wider uppercase text-white">Síguenos</h3>
                    <div class="flex space-x-6 mt-4 justify-center md:justify-start">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="ri-facebook-circle-fill text-2xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="ri-instagram-fill text-2xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="ri-twitter-x-fill text-2xl"></i></a>
                    </div>
                    <h3 class="text-sm font-semibold tracking-wider uppercase text-white mt-8">Contáctanos</h3>
                    <div class="mt-4">
                        <a href="{{ route('public.contact') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Ir a Contacto
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll-to-top Button -->
    <div x-data="{ showScrollToTop: false }"
         x-on:scroll.window="showScrollToTop = (window.scrollY > 300)"
         x-show="showScrollToTop"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-4"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-4"
         class="fixed bottom-8 right-8 z-50"
    >
        <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                class="bg-primary-600 hover:bg-primary-700 text-white w-12 h-12 flex items-center justify-center rounded-full shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-all duration-300 ease-in-out"
        >
            <i class="ri-arrow-up-line text-2xl"></i>
        </button>
    </div>

    <script src="https://unpkg.com/scrollreveal@4.0.9/dist/scrollreveal.min.js"></script>
    <script>
        // Initialize ScrollReveal
        window.sr = ScrollReveal();

        // Apply reveal to elements with data-scroll-reveal attribute
        window.sr.reveal('[data-scroll-reveal]', {
            delay: 200,
            distance: '50px',
            easing: 'ease-in-out',
            origin: 'bottom',
            interval: 100,
            mobile: true
        });
    </script>
    @livewireScripts
</body>
</html>
