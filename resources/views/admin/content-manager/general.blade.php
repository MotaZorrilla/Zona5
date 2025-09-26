<div class="p-4 sm:p-6 space-y-6">
    @livewire('admin.content-manager.brand-identity')

    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Gestión de Navegación Principal</h3>
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Sección</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Texto del Menú</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Visible</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                @foreach (['Página de Inicio' => 'Inicio', 'Quiénes Somos' => 'Quiénes Somos', 'Logias' => 'Logias', 'Recursos' => 'Recursos', 'Actualidad' => 'Actualidad', 'Contacto' => 'Contacto'] as $section => $menuText)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $section }}</td>
                    <td class="px-6 py-4"><input type="text" value="{{ $menuText }}" class="w-full rounded-md border-slate-300 shadow-sm text-sm"></td>
                    <td class="px-6 py-4 text-center">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" value="" class="sr-only peer" checked>
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary-600"></div>
                        </label>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Redes Sociales</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="social_facebook" class="block text-sm font-medium text-slate-700">URL de Facebook</label>
                <input type="url" id="social_facebook" placeholder="https://facebook.com/usuario" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="social_twitter" class="block text-sm font-medium text-slate-700">URL de Twitter / X</label>
                <input type="url" id="social_twitter" placeholder="https://twitter.com/usuario" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="social_instagram" class="block text-sm font-medium text-slate-700">URL de Instagram</label>
                <input type="url" id="social_instagram" placeholder="https://instagram.com/usuario" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
            </div>
            <div>
                <label for="social_youtube" class="block text-sm font-medium text-slate-700">URL de YouTube</label>
                <input type="url" id="social_youtube" placeholder="https://youtube.com/c/canal" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
            </div>
        </div>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">SEO</h3>
        <div class="space-y-4">
            <div>
                <label for="seo_title" class="block text-sm font-medium text-slate-700">Meta Título Global</label>
                <input type="text" id="seo_title" value="Gran Zona 5 - Masonería Universal" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
                <p class="mt-2 text-sm text-slate-500">Título que aparecerá en los buscadores. Idealmente entre 50-60 caracteres.</p>
            </div>
            <div>
                <label for="seo_description" class="block text-sm font-medium text-slate-700">Meta Descripción Global</label>
                <textarea id="seo_description" rows="3" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">Sitio oficial de la Gran Zona 5, un espacio para el estudio, la fraternidad y el desarrollo personal a través de la masonería.</textarea>
                <p class="mt-2 text-sm text-slate-500">Descripción para buscadores. Idealmente entre 150-160 caracteres.</p>
            </div>
             <div>
                <label for="seo_keywords" class="block text-sm font-medium text-slate-700">Meta Keywords (Opcional)</label>
                <input type="text" id="seo_keywords" value="masonería, zona 5, fraternidad, desarrollo personal, logias" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm sm:text-sm">
                <p class="mt-2 text-sm text-slate-500">Palabras clave separadas por comas. Menos relevante para SEO moderno, pero disponible.</p>
            </div>
        </div>
    </div>
    <div class="flex justify-end">
        <button class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500 active:bg-primary-700 focus:outline-none focus:border-primary-700 focus:ring ring-primary-200 disabled:opacity-25 transition ease-in-out duration-150">Guardar Cambios Generales</button>
    </div>
</div>
