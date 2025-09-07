<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gran Zona 5')</title>

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
    <header x-data="{ open: false }" class="absolute top-0 left-0 w-full z-20">
        <div class="relative max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <nav class="relative flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center flex-shrink-0">
                    <a href="{{ route('welcome') }}" class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-primary-500 flex items-center justify-center text-white text-xl font-bold">Z5</div>
                        <span class="ml-3 text-2xl font-bold text-white">Gran Zona 5</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
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

                    <a href="{{ route('public.news') }}" class="text-base font-medium text-white hover:text-primary-200">Noticias</a>
                    <a href="{{ route('public.contact') }}" class="text-base font-medium text-white hover:text-primary-200">Contacto</a>
                </div>

                <!-- Login/Register Buttons (Desktop) -->
                <div class="hidden md:block">
                    @if (Route::has('login'))
                        <livewire:welcome.navigation />
                    @endif
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
        <div x-show="open" x-transition:enter="duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="duration-100 ease-in" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden z-20">
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
                                <span class="ml-3 text-base font-medium text-gray-900">Noticias</span>
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
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                <!-- Logo and Copyright -->
                <div class="space-y-4 md:col-span-1">
                    <a href="{{ route('welcome') }}" class="inline-flex items-center justify-center md:justify-start">
                        <div class="w-10 h-10 rounded-full bg-primary-500 flex items-center justify-center text-white text-xl font-bold">Z5</div>
                        <span class="ml-3 text-2xl font-bold text-white">Gran Zona 5</span>
                    </a>
                    <p class="text-sm text-gray-400">
                        &copy; {{ date('Y') }} Gran Zona 5.<br>
                        Todos los derechos reservados.<br>
                        Jurisdiccionada a la Gran Logia de la República de Venezuela.
                    </p>
                    <p class="text-sm text-gray-500">
                        Desarrollado por <a href="https://motazorrilla.com" target="_blank" rel="noopener noreferrer" class="font-semibold text-primary-400 hover:text-white transition-colors">@MotaZorrilla</a>
                    </p>
                </div>

                <!-- Links -->
                <div class="md:col-span-1">
                    <h3 class="text-sm font-semibold tracking-wider uppercase text-gray-400">Enlaces Útiles</h3>
                    <ul class="mt-4 space-y-2 pl-4">
                        <li><a href="{{ route('public.sitemap') }}" class="text-base text-gray-300 hover:text-white transition-colors">Mapa del Sitio</a></li>
                        <li><a href="{{ route('privacy-policy') }}" class="text-base text-gray-300 hover:text-white transition-colors">Política de Privacidad</a></li>
                        <li><a href="{{ route('terms-of-service') }}" class="text-base text-gray-300 hover:text-white transition-colors">Términos de Servicio</a></li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div class="md:col-span-1">
                    <h3 class="text-sm font-semibold tracking-wider uppercase text-gray-400">Síguenos</h3>
                    <div class="flex space-x-6 mt-4 justify-center md:justify-start">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="ri-facebook-circle-fill text-2xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="ri-instagram-fill text-2xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="ri-twitter-x-fill text-2xl"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
