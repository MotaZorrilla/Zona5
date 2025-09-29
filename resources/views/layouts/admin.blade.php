
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Gran Zona 5</title>
    
    <x-favicon-link />
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @vite('resources/css/app.css')

    <style>
        :root {
            --primary-color: #6366F1; /* primary 500 original */
            --primary-hover: #4F46E5; /* primary 600 original */
            --secondary-color: #EC4899; /* Pink 500 original */
            --light-bg: #F3F4F6; /* Gray 100 original */
            --font-sans: 'Inter', sans-serif;
        }
        body {
            font-family: var(--font-sans);
            background-color: var(--light-bg);
        }
        .sidebar-header {
            color: white;
        }
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-link {
            transition: all 0.2s ease-in-out;
            color: white !important;
        }
        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.9); /* Fondo blanco atenuado en hover */
            color: black !important; /* Texto en negro en hover */
        }
        .sidebar-link:hover i,
        .sidebar-link:hover span {
            color: black !important; /* Asegurar que iconos y texto sean negros en hover */
        }
        /* Efecto degradado para los iconos y texto en hover */
        .sidebar-link.gradient-hover:hover i,
        .sidebar-link.gradient-hover:hover span {
            background: linear-gradient(45deg, #6366F1, #8B5CF6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }
        .sidebar-link.active {
            background-color: var(--primary-color);
            color: white !important;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.4), 0 2px 4px -1px rgba(99, 102, 241, 0.2);
        }
        .sidebar-link.active i {
            color: white !important;
        }
        .sidebar-link.active span {
            color: white !important;
        }
        .sidebar-link i {
            color: white !important;
        }
        .sidebar-link span {
            color: white !important;
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        html, body {
            overflow-x: hidden;
        }
    </style>
</head>
<body x-data="{ sidebarOpen: true }" x-cloak>

    <!-- Backdrop for mobile sidebar -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden" x-cloak></div>

    <x-admin.sidebar />

    <!-- Main Content -->
    <main class="min-h-screen transition-all overflow-x-hidden" :class="sidebarOpen ? 'lg:w-[calc(100%-256px)] lg:ml-64' : 'w-full'">
        <div class="p-6">
            <!-- Top Navbar -->
            <div class="py-2 px-6 bg-gradient-to-r from-indigo-700 to-purple-800 flex items-center shadow-sm rounded-lg sticky top-6 z-30">
                <button @click="sidebarOpen = !sidebarOpen" type="button" class="text-lg text-white" x-show="!sidebarOpen">
                    <i class="ri-menu-2-line"></i>
                </button>
                <div class="ml-auto flex items-center" x-data="{ profileOpen: false, quickAddOpen: false }">
                    <!-- Quick Add Button -->
                    <div class="mr-4 relative">
                        <button @click="quickAddOpen = !quickAddOpen" title="Crear Nuevo" class="text-indigo-800 hover:bg-indigo-200 w-8 h-8 flex items-center justify-center bg-white rounded-full shadow-md">
                            <i class="ri-add-line"></i>
                        </button>
                        <div x-show="quickAddOpen" @click.away="quickAddOpen = false" class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-xl py-1 z-20">
                            <p class="px-4 py-2 text-xs text-gray-500 bg-gray-50">Crear Nuevo...</p>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50"><i class="ri-user-add-line mr-2 text-indigo-600"></i>Nuevo Miembro</a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50"><i class="ri-bank-line mr-2 text-indigo-600"></i>Nueva Logia</a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50"><i class="ri-file-add-line mr-2 text-indigo-600"></i>Nuevo Documento</a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50"><i class="ri-calendar-2-line mr-2 text-indigo-600"></i>Nuevo Evento</a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50"><i class="ri-article-line mr-2 text-indigo-600"></i>Nueva Noticia</a>
                        </div>
                    </div>
                    
                    <!-- Notifications -->
                    <livewire:notifications />
                    <div class="relative" @click.away="profileOpen = false">
                        <button @click="profileOpen = !profileOpen" type="button" class="flex items-center">
                            <img src="https://i.pravatar.cc/32?u=admin" alt="" class="w-8 h-8 rounded-full object-cover">
                        </button>
                        <div x-show="profileOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl py-1 z-20">
                            <div class="px-4 py-2 border-b bg-gray-50">
                                <p class="text-sm font-semibold text-gray-800">Héctor Mota</p>
                                <p class="text-xs text-gray-500">SuperAdmin</p>
                            </div>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">Mi Perfil</a>
                            <hr class="my-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-indigo-50">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Top Navbar -->

            <div class="mt-6">
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-md" role="alert">
                        <p class="font-bold">Éxito</p>
                        <p>{{ session('success') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md" role="alert">
                        <p class="font-bold">Error</p>
                        <p>{{ session('error') }}</p>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </main>

    <!-- AlpineJS for interactivity -->
    @livewireScripts
    @vite('resources/js/app.js')
    @stack('scripts')
</body>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('refresh-page', () => {
            window.location.reload();
        });
    });
</script>
</html>
