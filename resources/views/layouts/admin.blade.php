
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Gran Zona 5</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>

    @vite('resources/css/app.css')

    <style>
        :root {
            --primary-color: #6366F1; /* primary 500 */
            --primary-hover: #4F46E5; /* primary 600 */
            --secondary-color: #EC4899; /* Pink 500 */
            --light-bg: #F3F4F6; /* Gray 100 */
            --font-sans: 'Inter', sans-serif;
        }
        body {
            font-family: var(--font-sans);
            background-color: var(--light-bg);
        }
        .sidebar {
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-link {
            transition: all 0.2s ease-in-out;
        }
        .sidebar-link:hover {
            background-color: #E0E7FF; /* primary 100 */
            color: var(--primary-hover);
        }
        .sidebar-link.active {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.4), 0 2px 4px -1px rgba(99, 102, 241, 0.2);
        }
        .stat-card {
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body x-data="{ sidebarOpen: true }">

    <x-admin.sidebar />

    <!-- Main Content -->
    <main class="min-h-screen transition-all" :class="sidebarOpen ? 'md:w-[calc(100%-256px)] md:ml-64' : 'w-full'">
        <!-- Top Navbar -->
        <div class="py-2 px-6 bg-white flex items-center shadow-sm sticky top-0 left-0 z-30">
            <button @click="sidebarOpen = !sidebarOpen" type="button" class="text-lg text-gray-600" x-show="!sidebarOpen">
                <i class="ri-menu-2-line"></i>
            </button>
            <div class="ml-auto flex items-center" x-data="{ profileOpen: false, quickAddOpen: false }">
                <div class="mr-4 relative">
                    <button @click="quickAddOpen = !quickAddOpen" title="Crear Nuevo" class="text-white hover:bg-primary-600 w-8 h-8 flex items-center justify-center bg-primary-500 rounded-full shadow-md">
                        <i class="ri-add-line"></i>
                    </button>
                    <div x-show="quickAddOpen" @click.away="quickAddOpen = false" class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-xl py-1 z-20">
                        <p class="px-4 py-2 text-xs text-gray-400">Crear Nuevo...</p>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="ri-user-add-line mr-2 text-primary-500"></i>Nuevo Miembro</a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="ri-bank-line mr-2 text-primary-500"></i>Nueva Logia</a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="ri-file-add-line mr-2 text-primary-500"></i>Nuevo Documento</a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="ri-calendar-2-line mr-2 text-primary-500"></i>Nuevo Evento</a>
                        <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="ri-article-line mr-2 text-primary-500"></i>Nueva Noticia</a>
                    </div>
                </div>
                <div class="relative" @click.away="profileOpen = false">
                    <button @click="profileOpen = !profileOpen" type="button" class="flex items-center">
                        <img src="https://i.pravatar.cc/32?u=admin" alt="" class="w-8 h-8 rounded-full object-cover">
                    </button>
                    <div x-show="profileOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl py-1 z-20">
                        <div class="px-4 py-2 border-b">
                            <p class="text-sm font-semibold">Héctor Mota</p>
                            <p class="text-xs text-gray-500">SuperAdmin</p>
                        </div>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Mi Perfil</a>
                        <hr class="my-1">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100">
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Navbar -->

        <div class="p-6">
            @yield('content')
        </div>
    </main>

    <!-- AlpineJS for interactivity -->
    <script src="//unpkg.com/alpinejs" defer></script>
</body>
</html>
