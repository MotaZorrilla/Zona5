<div class="p-4 sm:p-6 space-y-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Imagen de Cabecera</h3>
        <div>
            <label class="block text-sm font-medium text-slate-700">Banner para "Quiénes Somos"</label>
            <div class="mt-1 flex items-center">
                <img src="https://placehold.co/800x200/EFEFEF/AAAAAA&text=Banner+Quienes+Somos" alt="Banner About Us" class="h-20 mr-4 rounded w-auto">
                <input type="file" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
            </div>
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Contenido Principal</h3>
        <div class="space-y-4">
            <div>
                <label for="about_title" class="block text-sm font-medium text-slate-700">Título de la Página</label>
                <input type="text" id="about_title" value="Nuestra Historia y Misión" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="about_content" class="block text-sm font-medium text-slate-700">Contenido Principal (Editor de Texto Enriquecido)</label>
                <textarea id="about_content" rows="10" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm" placeholder="Detalla la historia, misión, visión y valores de la Gran Zona 5..."></textarea>
            </div>
        </div>
    </div>
     <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Sección de Dignatarios</h3>
         <div>
            <label for="about_dignitaries_title" class="block text-sm font-medium text-slate-700">Título de la Sección</label>
            <input type="text" id="about_dignitaries_title" value="Nuestros Dignatarios" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
        </div>
        <div class="mt-2">
            <label class="flex items-center">
                <input type="checkbox" checked class="rounded text-primary-600">
                <span class="ml-2 text-sm text-slate-600">Mostrar la sección de dignatarios en la página "Quiénes Somos".</span>
            </label>
        </div>
    </div>
    <div class="flex justify-end">
        <button class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:border-primary-700 focus:ring ring-primary-200 disabled:opacity-25 transition ease-in-out duration-150">Guardar Cambios de Quiénes Somos</button>
    </div>
</div>
