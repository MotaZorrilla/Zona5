<nav class="-mx-3 flex flex-1 justify-end items-center">
    @auth
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center text-white font-semibold px-4 py-2 rounded-md hover:bg-gray-700 focus:outline-none">
                <span>{{ Auth::user()->name }}</span>
                <i class="ri-arrow-down-s-line ml-1"></i>
            </button>

            <div x-show="open" 
                 @click.away="open = false" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 transform scale-100"
                 x-transition:leave-end="opacity-0 transform scale-95"
                 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-30">

                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    Mi Perfil
                </a>

                @if (Auth::user()->roles->contains('name', 'SuperAdmin') || Auth::user()->roles->contains('name', 'Admin'))
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Panel de Admin
                    </a>
                @endif

                <div class="border-t border-gray-100"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    @else
        <a
            href="{{ route('login') }}"
            class="inline-block bg-white text-primary-600 font-semibold px-4 py-2 rounded-md hover:bg-gray-200"
        >
            Iniciar Sesión
        </a>
    @endauth
</nav>
