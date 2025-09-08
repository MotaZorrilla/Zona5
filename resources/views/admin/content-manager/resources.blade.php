<div class="p-4 sm:p-6 space-y-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Imagen de Cabecera</h3>
        <div>
            <label class="block text-sm font-medium text-slate-700">Banner para "Recursos"</label>
            <div class="mt-1 flex items-center">
                <img src="https://placehold.co/800x200/EFEFEF/AAAAAA&text=Banner+Recursos" alt="Banner Recursos" class="h-20 mr-4 rounded w-auto">
                <input type="file" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
            </div>
        </div>
    </div>
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Configuración del Repositorio de Recursos</h3>
        <div class="space-y-4">
            <div>
                <label for="resources_title" class="block text-sm font-medium text-slate-700">Título de la Página</label>
                <input type="text" id="resources_title" value="Repositorio de Conocimiento" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="resources_intro" class="block text-sm font-medium text-slate-700">Texto Introductorio</label>
                <textarea id="resources_intro" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">Accede a una colección de documentos, trabajos y planchas masónicas. Filtra por grado, categoría y más.</textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="resources_per_page" class="block text-sm font-medium text-slate-700">Documentos por Página</label>
                    <input type="number" id="resources_per_page" value="12" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
                </div>
                <div>
                    <label for="resources_default_sort" class="block text-sm font-medium text-slate-700">Orden por Defecto</label>
                    <select id="resources_default_sort" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
                        <option>Más Recientes Primero</option>
                        <option>Más Antiguos Primero</option>
                        <option>Alfabético (A-Z)</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700">Comentarios</label>
                 <div class="mt-2">
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded text-primary-600">
                        <span class="ml-2 text-sm text-slate-600">Permitir comentarios en los documentos del repositorio.</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-end">
        <button class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:border-primary-700 focus:ring ring-primary-200 disabled:opacity-25 transition ease-in-out duration-150">Guardar Cambios de Recursos</button>
    </div>
</div>
