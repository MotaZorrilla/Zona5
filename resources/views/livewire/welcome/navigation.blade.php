<nav class="-mx-3 flex flex-1 justify-end">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="inline-block bg-white text-primary-600 font-semibold px-4 py-2 rounded-md hover:bg-gray-200"
        >
            Dashboard
        </a>
    @else
        <a
            href="{{ route('login') }}"
            class="inline-block bg-white text-primary-600 font-semibold px-4 py-2 rounded-md hover:bg-gray-200"
        >
            Iniciar Sesión
        </a>

        @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="inline-block bg-primary-500 text-white font-semibold px-4 py-2 rounded-md hover:bg-primary-600 ml-4"
            >
                Registro
            </a>
        @endif
    @endauth
</nav>
