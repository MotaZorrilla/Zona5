<div class="p-4 sm:p-6 space-y-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">Identidad y Marca</h3>
        <div class="space-y-4">
            <div>
                <label for="site_name" class="block text-sm font-medium text-slate-700">Nombre del Sitio</label>
                <input type="text" id="site_name" value="Gran Zona 5" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            </div>
            <div>
                <label for="theme_color" class="block text-sm font-medium text-slate-700">Color Principal del Tema</label>
                <input type="color" id="theme_color" value="#3b82f6" class="mt-1 block w-20 h-10 rounded-md border-slate-300 shadow-sm">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700">Logo del Sitio (Modo Claro)</label>
                    <div class="mt-1 flex items-center">
                        <img src="https://placehold.co/150x50/EFEFEF/AAAAAA&text=Logo" alt="Logo" class="h-12 mr-4 bg-slate-200 p-1 rounded">
                        <input type="file" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700">Favicon</label>
                    <div class="mt-1 flex items-center">
                        <img src="https://placehold.co/32x32/EFEFEF/AAAAAA&text=ico" alt="Favicon" class="h-8 w-8 mr-4">
                        <input type="file" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        <h3 class="text-xl font-bold text-slate-800 mb-4">Pie de Página y Contacto</h3>
        <div class="space-y-4">
            <div>
                <label for="footer_copyright" class="block text-sm font-medium text-slate-700">Texto de Copyright</label>
                <input type="text" id="footer_copyright" value="© 2025 Gran Zona 5. Todos los derechos reservados." class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            </div>
            <div>
                <label for="footer_email" class="block text-sm font-medium text-slate-700">Email de Contacto General</label>
                <input type="email" id="footer_email" value="contacto@granzona5.org" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            </div>
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
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-xl font-bold text-slate-800 mb-4">SEO y Ajustes Avanzados</h3>
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
