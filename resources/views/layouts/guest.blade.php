<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Merriweather:wght@400;700;900&display=swap" rel="stylesheet">

    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        :root {
            --primary-color: #1D4ED8; /* Vibrant Blue */
            --primary-hover: #1E40AF; /* Darker Vibrant Blue */
            --secondary-color: #EC4899; /* Pink 500 */
            --light-bg: #F9FAFB; /* Gray 50 */
            --font-sans: 'Inter', sans-serif;
            --font-serif: 'Merriweather', serif;
        }
        body {
            font-family: var(--font-sans);
        }
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: var(--font-serif);
        }
    </style>
</head>
<body class="antialiased text-gray-900">
    <div class="relative min-h-screen flex flex-col items-center justify-center bg-gray-100">
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="Background">
            <div class="absolute inset-0 bg-primary-800 mix-blend-multiply"></div>
        </div>

        <!-- Header Logo -->
        <header class="absolute top-0 left-0 w-full z-10 p-6">
            <a href="/" wire:navigate class="flex items-center">
                <x-application-logo class="w-10 h-10 rounded-full bg-white flex items-center justify-center text-primary-500 text-xl font-bold" />
                <span class="ml-3 text-2xl font-bold text-white">Gran Zona 5</span>
            </a>
        </header>

        <!-- Form Card -->
        <main class="relative z-10 w-full sm:max-w-md mt-6 mb-6 px-6 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-2xl">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="relative z-10 w-full py-4">
            <p class="text-center text-base text-gray-300 font-medium">&copy; {{ date('Y') }} Gran Zona 5 - Todos los derechos reservados</p>
            <p class="text-center text-base text-gray-300 font-medium mt-1">Jurisdiccionada a la <a href="https://www.granlogiadevenezuela.com" target="_blank" class="font-bold text-white hover:text-primary-200 transition-colors">Gran Logia de la República de Venezuela</a></p>
            <p class="text-center text-base text-gray-300 font-medium mt-3">Desarrollado por <a href="https://motazorrilla.com" target="_blank" class="font-bold text-white hover:text-primary-200 transition-colors">@MotaZorrilla</a></p>
        </footer>
    </div>
    @livewireScripts
</body>
</html>