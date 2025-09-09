<div>
    <!-- Contenido original -->
    {{ $slot }}

    <!-- Capa superpuesta FIJA con sombreado y mensaje -->
    <!-- `pointer-events-none` permite hacer scroll en el contenido de atrás -->
    <div class="pointer-events-none fixed inset-0 z-40 flex items-center justify-center bg-gray-900 bg-opacity-60">
        <div class="pointer-events-auto rounded-md bg-indigo-700 px-6 py-3 text-center shadow-lg">
            <span class="text-9xl mb-2">🚧</span>
            <h2 class="text-2xl font-bold text-white">¡En Construcción!</h2>
            <p class="text-blue-200">Esta sección estará disponible próximamente.</p>
        </div>
    </div>
</div>
