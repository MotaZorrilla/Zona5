<div class="p-4 sm:p-6 space-y-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Sección Principal (Hero)</h3>
        <div class="space-y-4">
            <div>
                <label for="home_hero_title" class="block text-sm font-medium text-slate-700">Título Principal</label>
                <input type="text" id="home_hero_title" value="Bienvenidos a la Gran Zona 5" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="home_hero_subtitle" class="block text-sm font-medium text-slate-700">Subtítulo</label>
                <textarea id="home_hero_subtitle" rows="2" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">Un faro de conocimiento y fraternidad en el corazón de nuestra comunidad.</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Imagen de Fondo</label>
                <div class="mt-1 flex items-center">
                    <img src="https://placehold.co/800x200/EFEFEF/AAAAAA&text=Banner+Inicio" alt="Background" class="h-20 mr-4 rounded w-auto">
                    <input type="file" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="home_hero_cta_text" class="block text-sm font-medium text-slate-700">Texto del Botón (CTA)</label>
                    <input type="text" id="home_hero_cta_text" value="Conoce Más" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
                </div>
                <div>
                    <label for="home_hero_cta_link" class="block text-sm font-medium text-slate-700">Enlace del Botón (CTA)</label>
                    <input type="text" id="home_hero_cta_link" value="/about-us" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Sección de Bienvenida</h3>
         <div>
            <label for="home_welcome_content" class="block text-sm font-medium text-slate-700">Contenido de Bienvenida (Editor de Texto Enriquecido)</label>
            <textarea id="home_welcome_content" rows="6" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm" placeholder="Usa este espacio para un mensaje de bienvenida más detallado..."></textarea>
            <p class="mt-2 text-sm text-slate-500">Este contenido aparecerá debajo de la sección principal.</p>
        </div>
    </div>
     <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Contenido Destacado</h3>
        <div class="space-y-4">
            <div>
                <label for="home_featured_title" class="block text-sm font-medium text-slate-700">Título de la Sección</label>
                <input type="text" id="home_featured_title" value="Noticias y Recursos Destacados" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Destacado 1 -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-700">Destacado 1</label>
                    <img src="https://placehold.co/400x300/EFEFEF/AAAAAA&text=Destacado+1" class="rounded shadow-lg w-full h-auto mb-2">
                    <input type="file" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 w-full">
                    <select class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
                        <option>Última Noticia: Evento Anual</option>
                        <option>Recurso: El Simbolismo del Compás</option>
                        <option>-- Ninguno --</option>
                    </select>
                </div>
                <!-- Destacado 2 -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-700">Destacado 2</label>
                    <img src="https://placehold.co/400x300/EFEFEF/AAAAAA&text=Destacado+2" class="rounded shadow-lg w-full h-auto mb-2">
                    <input type="file" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 w-full">
                    <select class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
                        <option>Recurso: El Simbolismo del Compás</option>
                        <option>Última Noticia: Evento Anual</option>
                        <option>-- Ninguno --</option>
                    </select>
                </div>
                <!-- Destacado 3 -->
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-slate-700">Destacado 3</label>
                    <img src="https://placehold.co/400x300/EFEFEF/AAAAAA&text=Destacado+3" class="rounded shadow-lg w-full h-auto mb-2">
                    <input type="file" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 w-full">
                    <select class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
                        <option>-- Ninguno --</option>
                        <option>Recurso: El Simbolismo del Compás</option>
                        <option>Última Noticia: Evento Anual</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-end">
        <button class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:border-primary-700 focus:ring ring-primary-200 disabled:opacity-25 transition ease-in-out duration-150">Guardar Cambios de Inicio</button>
    </div>
</div>
