@extends('layouts.admin')

@section('title', 'Gestor de Contenido del Sitio')

@section('content')
<div class="bg-white p-8 rounded-xl shadow-lg">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Gestor de Contenido del Sitio</h1>
    <p class="text-gray-500 mb-8">Modifica los textos e imágenes principales de las páginas públicas.</p>

    <div x-data="{ tab: 'general' }">
        <!-- Pestañas de Navegación -->
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8 overflow-x-auto" aria-label="Tabs">
                <button @click="tab = 'general'" :class="{ 'border-primary-500 text-primary-600': tab === 'general', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'general' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">General</button>
                <button @click="tab = 'inicio'" :class="{ 'border-primary-500 text-primary-600': tab === 'inicio', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'inicio' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Página de Inicio</button>
                <button @click="tab = 'quienes'" :class="{ 'border-primary-500 text-primary-600': tab === 'quienes', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'quienes' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Quiénes Somos</button>
                <button @click="tab = 'logias'" :class="{ 'border-primary-500 text-primary-600': tab === 'logias', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'logias' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Logias</button>
                <button @click="tab = 'recursos'" :class="{ 'border-primary-500 text-primary-600': tab === 'recursos', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'recursos' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Recursos</button>
                <button @click="tab = 'noticias'" :class="{ 'border-primary-500 text-primary-600': tab === 'noticias', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'noticias' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Noticias</button>
                <button @click="tab = 'contacto'" :class="{ 'border-primary-500 text-primary-600': tab === 'contacto', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'contacto' }" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">Contacto</button>
            </nav>
        </div>

        <!-- Contenido de las Pestañas -->
        <div class="mt-8">
            <!-- Pestaña: General -->
            <div x-show="tab === 'general'" x-transition>
                <form action="#" method="POST" class="space-y-12">
                    @csrf
                    <!-- Sección de Identidad y Marca -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Identidad y Marca</h3>
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-x-8 gap-y-6 mt-6">
                            <div class="lg:col-span-2">
                                <div class="space-y-4">
                                    <div>
                                        <label for="site_name" class="block text-sm font-medium text-gray-700">Nombre del Sitio</label>
                                        <input type="text" name="site_name" id="site_name" value="Gran Zona 5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                    </div>
                                    <div>
                                        <label for="theme_color" class="block text-sm font-medium text-gray-700">Color Principal del Tema</label>
                                        <div class="mt-1 flex items-center">
                                            <input type="color" name="theme_color" id="theme_color" value="#1D4ED8" class="w-10 h-10 p-1 border border-gray-300 rounded-md cursor-pointer">
                                            <span class="ml-3 text-gray-500">Haz clic en el cuadro para elegir un color.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lg:col-span-1 space-y-4">
                                <div class="p-4 border-2 border-dashed border-gray-300 rounded-lg text-center h-full flex flex-col justify-center">
                                    <p class="text-sm text-gray-600 mb-2">Logo Actual:</p>
                                    <div class="inline-block bg-gray-100 p-2 rounded-lg">
                                        <img src="https://picsum.photos/seed/logo/150/150" alt="Logo Actual" class="h-16 w-16 object-contain mx-auto">
                                    </div>
                                    <div class="mt-2">
                                        <label for="general_logo" class="cursor-pointer text-sm font-medium text-primary-600 hover:text-primary-500">Cambiar Logo</label>
                                        <input id="general_logo" name="general_logo" type="file" class="sr-only">
                                    </div>
                                </div>
                                <div class="p-4 border-2 border-dashed border-gray-300 rounded-lg text-center h-full flex flex-col justify-center">
                                     <p class="text-sm text-gray-600 mb-2">Favicon Actual:</p>
                                    <div class="inline-block bg-gray-100 p-2 rounded-lg">
                                        <img src="https://picsum.photos/seed/favicon/64/64" alt="Favicon Actual" class="h-8 w-8 object-contain mx-auto">
                                    </div>
                                    <div class="mt-2">
                                        <label for="favicon" class="cursor-pointer text-sm font-medium text-primary-600 hover:text-primary-500">Cambiar Favicon</label>
                                        <input id="favicon" name="favicon" type="file" class="sr-only">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gestor de Secciones -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Gestión de Navegación Principal</h3>
                        <p class="text-sm text-gray-600 mb-4">Controla qué páginas son visibles en el menú y edita el texto del enlace.</p>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sección</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Texto en Menú</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Visibilidad</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200" x-data="{ sections: [ { name: 'Quiénes Somos', visible: true }, { name: 'Logias', visible: true }, { name: 'Recursos', visible: true }, { name: 'Noticias', visible: true }, { name: 'Contacto', visible: true } ] }">
                                    <template x-for="section in sections" :key="section.name">
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" x-text="section.name"></td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="text" :value="section.name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <button type="button" @click="section.visible = !section.visible" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" :class="section.visible ? 'bg-primary-600' : 'bg-gray-200'">
                                                    <span aria-hidden="true" :class="section.visible ? 'translate-x-5' : 'translate-x-0'" class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200"></span>
                                                </button>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Gestor de Pie de Página y Contacto -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Pie de Página y Contacto</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <div>
                                    <label for="footer_copyright" class="block text-sm font-medium text-gray-700">Texto de Copyright</label>
                                    <textarea name="footer_copyright" id="footer_copyright" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">&copy; {{ date('Y') }} Gran Zona 5. Todos los derechos reservados.</textarea>
                                </div>
                                <div>
                                    <label for="general_email_footer" class="block text-sm font-medium text-gray-700">Email de Contacto (Footer)</label>
                                    <input type="email" name="general_email_footer" id="general_email_footer" value="contacto@granlogia.org.ve" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                </div>
                            </div>
                            <div class="space-y-4">
                                 <h4 class="text-sm font-medium text-gray-700">Redes Sociales (Footer)</h4>
                                <div class="flex items-center">
                                    <i class="ri-facebook-circle-fill text-2xl text-gray-400 mr-3"></i>
                                    <input type="url" name="social_facebook_footer" placeholder="https://facebook.com/tu-pagina" class="flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                </div>
                                <div class="flex items-center">
                                    <i class="ri-instagram-fill text-2xl text-gray-400 mr-3"></i>
                                    <input type="url" name="social_instagram_footer" placeholder="https://instagram.com/tu-usuario" class="flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                </div>
                                <div class="flex items-center">
                                    <i class="ri-twitter-x-fill text-2xl text-gray-400 mr-3"></i>
                                    <input type="url" name="social_twitter_footer" placeholder="https://twitter.com/tu-usuario" class="flex-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- SEO y Ajustes Avanzados -->
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">SEO y Ajustes Avanzados</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="seo_title" class="block text-sm font-medium text-gray-700">Meta Título Global</label>
                                <input type="text" name="seo_title" id="seo_title" placeholder="Gran Logia de la República de Venezuela - Zona 5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            </div>
                            <div>
                                <label for="seo_description" class="block text-sm font-medium text-gray-700">Meta Descripción Global</label>
                                <textarea name="seo_description" id="seo_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm" placeholder="Portal oficial de la Gran Zona 5 de la Gran Logia de la República de Venezuela..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="pt-12 flex justify-end">
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-transform transform hover:scale-105">Guardar Todos los Cambios Generales</button>
                    </div>
                </form>
            </div>

            <!-- Pestaña: Página de Inicio -->
            <div x-show="tab === 'inicio'" x-transition style="display: none;">
                <form action="#" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <div class="md:col-span-2">
                            <h3 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Sección Principal (Hero)</h3>
                        </div>
                        <div>
                            <label for="hero_title_1" class="block text-sm font-medium text-gray-700">Título Principal (Línea 1)</label>
                            <input type="text" name="hero_title_1" id="hero_title_1" value="Tradición y Futuro" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="hero_title_2" class="block text-sm font-medium text-gray-700">Título Principal (Línea 2)</label>
                            <input type="text" name="hero_title_2" id="hero_title_2" value="Uniendo la Masonería" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="hero_subtitle" class="block text-sm font-medium text-gray-700">Párrafo de Bienvenida</label>
                            <textarea name="hero_subtitle" id="hero_subtitle" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">Un espacio para el encuentro, el conocimiento y la fraternidad de todas las Logias que conforman la Gran Zona 5 de la Gran Logia de la República de Venezuela.</textarea>
                        </div>
                        <div class="md:col-span-2 mt-6">
                            <h3 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Sección de Pilares</h3>
                        </div>
                        <div>
                            <label for="pillar1_title" class="block text-sm font-medium text-gray-700">Pilar 1: Título</label>
                            <input type="text" name="pillar1_title" id="pillar1_title" value="Conocimiento" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="pillar1_desc" class="block text-sm font-medium text-gray-700">Pilar 1: Descripción</label>
                            <input type="text" name="pillar1_desc" id="pillar1_desc" value="Accede a un repositorio de planchas, trazados y documentos para el estudio y la reflexión." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="pillar2_title" class="block text-sm font-medium text-gray-700">Pilar 2: Título</label>
                            <input type="text" name="pillar2_title" id="pillar2_title" value="Fraternidad" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="pillar2_desc" class="block text-sm font-medium text-gray-700">Pilar 2: Descripción</label>
                            <input type="text" name="pillar2_desc" id="pillar2_desc" value="Encuentra información sobre las logias de la zona y fortalece los lazos que nos unen." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="pillar3_title" class="block text-sm font-medium text-gray-700">Pilar 3: Título</label>
                            <input type="text" name="pillar3_title" id="pillar3_title" value="Comunidad" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="pillar3_desc" class="block text-sm font-medium text-gray-700">Pilar 3: Descripción</label>
                            <input type="text" name="pillar3_desc" id="pillar3_desc" value="Mantente al día con las últimas noticias, eventos y comunicados de la Gran Zona 5." class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                    <div class="pt-8 flex justify-end">
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">Guardar Cambios</button>
                    </div>
                </form>
            </div>

            <!-- Pestaña: Página Quiénes Somos -->
            <div x-show="tab === 'quienes'" x-transition style="display: none;">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Contenido de la Página "Quiénes Somos"</h3>
                    </div>
                    <div>
                        <label for="qs_historia" class="block text-sm font-medium text-gray-700">Párrafo de "Nuestra Historia"</label>
                        <textarea name="qs_historia" id="qs_historia" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">La Masonería en la región de Guayana tiene raíces profundas, entrelazadas con el desarrollo social, cultural y político del Estado Bolívar. Desde la fundación de las primeras logias, los hermanos masones han sido pilares en la construcción de una sociedad más justa, educada y fraterna.</textarea>
                    </div>
                    <div>
                        <label for="qs_cita" class="block text-sm font-medium text-gray-700">Cita Destacada</label>
                        <input type="text" name="qs_cita" id="qs_cita" value='"Buscamos hacer de hombres buenos, mejores hombres. Hombres comprometidos con su entorno, su familia y su país."' class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="qs_mision" class="block text-sm font-medium text-gray-700">Texto de "Misión"</label>
                        <textarea name="qs_mision" id="qs_mision" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">Preservar y transmitir los principios universales de la Francmasonería: Libertad, Igualdad y Fraternidad. Fomentamos el estudio filosófico, el desarrollo moral y la práctica de la filantropía entre nuestros miembros.</textarea>
                    </div>
                    <div>
                        <label for="qs_vision" class="block text-sm font-medium text-gray-700">Texto de "Visión"</label>
                        <textarea name="qs_vision" id="qs_vision" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">Aspiramos a ser una institución relevante y respetada, reconocida por su contribución positiva al progreso de la sociedad guayanesa, formando líderes éticos y ciudadanos ejemplares que trabajen por el bienestar común.</textarea>
                    </div>
                    <div class="pt-8 flex justify-end">
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">Guardar Cambios</button>
                    </div>
                </form>
            </div>

            <!-- Pestaña: Logias -->
            <div x-show="tab === 'logias'" x-transition style="display: none;">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Contenido de la Página de Logias</h3>
                    </div>
                    <div>
                        <label for="logias_hero_title" class="block text-sm font-medium text-gray-700">Título Principal</label>
                        <input type="text" name="logias_hero_title" id="logias_hero_title" value="Nuestras Logias" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="logias_hero_subtitle" class="block text-sm font-medium text-gray-700">Subtítulo</label>
                        <textarea name="logias_hero_subtitle" id="logias_hero_subtitle" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">Un crisol de tradición y fraternidad a lo largo de la Gran Zona 5.</textarea>
                    </div>
                    <div class="pt-8 flex justify-end">
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">Guardar Cambios</button>
                    </div>
                </form>
            </div>

            <!-- Pestaña: Página Recursos -->
            <div x-show="tab === 'recursos'" x-transition style="display: none;">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Contenido de Páginas de Recursos</h3>
                    </div>
                    <div>
                        <label for="recursos_forums" class="block text-sm font-medium text-gray-700">Párrafo Introductorio de "Foros"</label>
                        <textarea name="recursos_forums" id="recursos_forums" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">Un espacio para el diálogo constructivo, el intercambio de ideas y el fortalecimiento de la fraternidad.</textarea>
                    </div>
                    <div>
                        <label for="recursos_school" class="block text-sm font-medium text-gray-700">Párrafo Introductorio de "Escuela Virtual"</label>
                        <textarea name="recursos_school" id="recursos_school" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">Fomentando la luz del conocimiento a través de la formación continua, síncrona y asíncrona.</textarea>
                    </div>
                    <div>
                        <label for="recursos_archive" class="block text-sm font-medium text-gray-700">Párrafo Introductorio de "Archivo Histórico"</label>
                        <textarea name="recursos_archive" id="recursos_archive" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">Un viaje a través de los documentos que han marcado nuestra historia.</textarea>
                    </div>
                    <div class="pt-8 flex justify-end">
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">Guardar Cambios</button>
                    </div>
                </form>
            </div>

            <!-- Pestaña: Noticias -->
            <div x-show="tab === 'noticias'" x-transition style="display: none;">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Contenido de la Página de Noticias</h3>
                    </div>
                    <div>
                        <label for="noticias_hero_title" class="block text-sm font-medium text-gray-700">Título Principal</label>
                        <input type="text" name="noticias_hero_title" id="noticias_hero_title" value="Noticias y Eventos" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="noticias_hero_subtitle" class="block text-sm font-medium text-gray-700">Subtítulo</label>
                        <textarea name="noticias_hero_subtitle" id="noticias_hero_subtitle" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">Mantente al día con las últimas novedades de la Gran Zona 5.</textarea>
                    </div>
                    <div class="pt-8 flex justify-end">
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">Guardar Cambios</button>
                    </div>
                </form>
            </div>

            <!-- Pestaña: Contacto -->
            <div x-show="tab === 'contacto'" x-transition style="display: none;">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <h3 class="text-xl font-semibold text-gray-700 border-b pb-2 mb-4">Contenido de la Página de Contacto</h3>
                    </div>
                    <div>
                        <label for="contacto_hero_title" class="block text-sm font-medium text-gray-700">Título Principal</label>
                        <input type="text" name="contacto_hero_title" id="contacto_hero_title" value="Ponte en Contacto" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="contacto_hero_subtitle" class="block text-sm font-medium text-gray-700">Subtítulo</label>
                        <textarea name="contacto_hero_subtitle" id="contacto_hero_subtitle" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">¿Tienes alguna pregunta o quieres saber más sobre nosotros? No dudes en contactarnos.</textarea>
                    </div>
                    <div class="pt-8 flex justify-end">
                        <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-6 rounded-lg shadow-md">Guardar Cambios</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
