<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gran Zona 5 - Sitio Público V2</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Merriweather:wght@400;700;900&display=swap" rel="stylesheet">

    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet"/>

    @vite('resources/css/app.css')

    <style>
        :root {
            --primary-color: #6366F1; /* Indigo 500 */
            --primary-hover: #4F46E5; /* Indigo 600 */
            --secondary-color: #EC4899; /* Pink 500 */
            --light-bg: #F9FAFB; /* Gray 50 */
            --font-sans: 'Inter', sans-serif;
            --font-serif: 'Merriweather', serif;
        }
        body {
            font-family: var(--font-sans);
            background-color: white;
            color: #374151; /* Gray 700 */
        }
        h1, h2, h3, h4, h5, h6, .font-serif {
            font-family: var(--font-serif);
        }
        .cta-button {
            transition: all 0.3s ease;
        }
        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(99, 102, 241, 0.3), 0 4px 6px -2px rgba(99, 102, 241, 0.2);
        }
        .feature-card {
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
        }
    </style>
</head>
<body>

    <!-- Header & Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <div class="absolute inset-0">
            <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="Biblioteca">
            <div class="absolute inset-0 bg-gray-900 bg-opacity-75"></div>
        </div>
        <div class="relative max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <!-- Navbar -->
            <nav class="relative flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center text-white text-xl font-bold">Z5</div>
                    <span class="ml-3 text-2xl font-bold text-white">Gran Zona 5</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-base font-medium text-white hover:text-indigo-200">Logias</a>
                    <a href="#" class="text-base font-medium text-white hover:text-indigo-200">Archivo</a>
                    <a href="#" class="text-base font-medium text-white hover:text-indigo-200">Noticias</a>
                    <a href="#" class="text-base font-medium text-white hover:text-indigo-200">Contacto</a>
                </div>
                <div class="hidden md:block">
                    <a href="#" class="inline-block bg-white text-indigo-600 font-semibold px-4 py-2 rounded-md hover:bg-gray-200">Iniciar Sesión</a>
                </div>
            </nav>

            <!-- Hero Content -->
            <div class="mt-24 text-center">
                <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl font-serif">
                    <span class="block">Tradición y Futuro</span>
                    <span class="block text-indigo-300">Uniendo la Masonería</span>
                </h1>
                <p class="mt-3 max-w-md mx-auto text-base text-gray-300 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
                    Un espacio para el encuentro, el conocimiento y la fraternidad de todas las Logias que conforman la Gran Zona 5 de la Gran Logia de la República de Venezuela.
                </p>
                <div class="mt-5 max-w-md mx-auto sm:flex sm:justify-center md:mt-8">
                    <div class="rounded-md shadow">
                        <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 cta-button md:py-4 md:text-lg md:px-10">Conoce las Logias</a>
                    </div>
                    <div class="mt-3 rounded-md shadow sm:mt-0 sm:ml-3">
                        <a href="#" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-gray-50 cta-button md:py-4 md:text-lg md:px-10">Explora el Archivo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pillars Section -->
    <div class="bg-gray-50">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 font-serif">Nuestros Pilares</h2>
                <p class="mt-4 text-lg text-gray-500">Fomentando los valores que nos unen y nos hacen crecer.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-lg shadow-md border-t-4 border-transparent feature-card">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-indigo-500 text-white">
                        <i class="ri-archive-line text-2xl"></i>
                    </div>
                    <h3 class="mt-5 text-lg font-medium text-gray-900">Conocimiento</h3>
                    <p class="mt-2 text-base text-gray-500">Accede a un repositorio de planchas, trazados y documentos para el estudio y la reflexión.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md border-t-4 border-transparent feature-card">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-pink-500 text-white">
                        <i class="ri-group-2-line text-2xl"></i>
                    </div>
                    <h3 class="mt-5 text-lg font-medium text-gray-900">Fraternidad</h3>
                    <p class="mt-2 text-base text-gray-500">Encuentra información sobre las logias de la zona y fortalece los lazos que nos unen.</p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-md border-t-4 border-transparent feature-card">
                    <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-500 text-white">
                        <i class="ri-calendar-event-line text-2xl"></i>
                    </div>
                    <h3 class="mt-5 text-lg font-medium text-gray-900">Comunidad</h3>
                    <p class="mt-2 text-base text-gray-500">Mantente al día con las últimas noticias, eventos y comunicados de la Gran Zona 5.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- News Section -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-extrabold text-gray-900 font-serif">Últimas Noticias y Eventos</h2>
                <p class="mt-4 text-lg text-gray-500">La actualidad de nuestra zona, al alcance de todos.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-shrink-0">
                        <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="">
                    </div>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-indigo-600">EVENTO</p>
                            <a href="#" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900">Tenida de Solsticio de Invierno</p>
                                <p class="mt-3 text-base text-gray-500">Invitamos a todos los QQ.`.`HH.`.` a la magna tenida que se celebrará en el Templo Principal.</p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="text-sm text-gray-500">21 de Junio, 2025</div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-shrink-0">
                        <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1742&q=80" alt="">
                    </div>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-pink-600">NOTICIA</p>
                            <a href="#" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900">Balance Anual de la Gran Zona 5</p>
                                <p class="mt-3 text-base text-gray-500">El Gran Delegado Zonal presenta el balance de los trabajos y el crecimiento de la membresía.</p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="text-sm text-gray-500">15 de Septiembre, 2025</div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-shrink-0">
                        <img class="h-48 w-full object-cover" src="https://images.unsplash.com/photo-1543269865-cbf427effbad?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1740&q=80" alt="">
                    </div>
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-green-600">COMUNICADO</p>
                            <a href="#" class="block mt-2">
                                <p class="text-xl font-semibold text-gray-900">Nueva Edición del Manual de Rito</p>
                                <p class="mt-3 text-base text-gray-500">Ya se encuentra disponible en el repositorio la nueva edición revisada del manual del R.`.`E.`.`A.`.`A.`.`</p>
                            </a>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="text-sm text-gray-500">1 de Septiembre, 2025</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-indigo-700">
        <div class="max-w-2xl mx-auto text-center py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl font-serif">
                <span class="block">Fortaleciendo nuestros lazos.</span>
                <span class="block">Iluminando nuestro camino.</span>
            </h2>
            <p class="mt-4 text-lg leading-6 text-indigo-200">¿Eres un hermano de visita? ¿Interesado en conocer más sobre nuestros trabajos? Contáctanos.</p>
            <a href="#" class="mt-8 w-full inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-indigo-600 bg-white hover:bg-indigo-50 sm:w-auto">Ponerse en Contacto</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
            <div class="flex justify-center space-x-6 md:order-2">
                <a href="#" class="text-gray-400 hover:text-white"><i class="ri-facebook-circle-fill text-2xl"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="ri-instagram-fill text-2xl"></i></a>
                <a href="#" class="text-gray-400 hover:text-white"><i class="ri-twitter-x-fill text-2xl"></i></a>
            </div>
            <div class="mt-8 md:mt-0 md:order-1">
                <p class="text-center text-base text-gray-400">&copy; 2025 Gran Zona 5, G.`.`L.`.`R.`.`V.`.` Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

</body>
</html>