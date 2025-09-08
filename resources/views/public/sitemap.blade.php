@extends('layouts.public')

@section('title', 'Mapa del Sitio Detallado')

@section('content')
    <x-public.hero 
        title="Mapa del Sitio Detallado" 
        subtitle="Explora la estructura completa de nuestro contenido."
        imageUrl="https://picsum.photos/seed/sitemap-hero/1920/1080"
    />

    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-4xl px-6 lg:px-8">
            <div class="space-y-12">
                <!-- Inicio -->
                <div data-scroll-reveal>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif border-b pb-4">Inicio</h2>
                    <ul class="mt-4 space-y-2 list-disc list-inside">
                        <li><a href="{{ route('welcome') }}" class="text-primary-600 hover:underline font-semibold">Página Principal</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Pilares</li>
                                <li>Últimas Noticias y Eventos</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Quiénes Somos -->
                <div data-scroll-reveal>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif border-b pb-4">Quiénes Somos</h2>
                    <ul class="mt-4 space-y-2 list-disc list-inside">
                        <li><a href="{{ route('public.about-us') }}" class="text-primary-600 hover:underline font-semibold">Quiénes Somos</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Historia</li>
                                <li>Misión y Visión</li>
                                <li>Valores</li>
                                <li>Junta Directiva</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Logias -->
                <div data-scroll-reveal>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif border-b pb-4">Logias</h2>
                    <ul class="mt-4 space-y-2 list-disc list-inside">
                        <li><a href="{{ route('public.lodges') }}" class="text-primary-600 hover:underline font-semibold">Listado de Logias</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Logias de Ciudad Guayana</li>
                                <li>Logias de Upata</li>
                                <li>Logias de Ciudad Bolívar</li>
                            </ul>
                        </li>
                        <li><a href="{{ route('public.lodges.show', 'sol-de-guayana-88') }}" class="text-primary-600 hover:underline font-semibold">Página de Detalle de Logia</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Historia</li>
                                <li>Próximos Eventos</li>
                                <li>Cuadro Logial (Dignatarios)</li>
                                <li>Ubicación (Mapa)</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Actualidad -->
                <div data-scroll-reveal>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif border-b pb-4">Actualidad</h2>
                    <ul class="mt-4 space-y-2 list-disc list-inside">
                        <li><a href="{{ route('public.news') }}" class="text-primary-600 hover:underline font-semibold">Actualidad</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Noticias</li>
                                <li>Eventos</li>
                                <li>Galería</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Contacto -->
                <div data-scroll-reveal>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif border-b pb-4">Contacto</h2>
                    <ul class="mt-4 space-y-2 list-disc list-inside">
                        <li><a href="{{ route('public.contact') }}" class="text-primary-600 hover:underline font-semibold">Contacto</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Formulario de Contacto</li>
                                <li>Información de dirección, email</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Preguntas Frecuentes (FAQ) -->
                <div data-scroll-reveal>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif border-b pb-4">Preguntas Frecuentes (FAQ)</h2>
                    <ul class="mt-4 space-y-2 list-disc list-inside">
                        <li><a href="{{ route('public.faq') }}" class="text-primary-600 hover:underline font-semibold">Preguntas Frecuentes</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Listado de Preguntas y Respuestas</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Recursos -->
                <div data-scroll-reveal>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif border-b pb-4">Recursos</h2>
                    <ul class="mt-4 space-y-2 list-disc list-inside">
                        <li><a href="{{ route('public.school') }}" class="text-primary-600 hover:underline font-semibold">Escuela Virtual</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Próximas Clases en Vivo</li>
                                <li>Catálogo de Cursos Asíncronos</li>
                            </ul>
                        </li>
                        <li><a href="{{ route('public.forums') }}" class="text-primary-600 hover:underline font-semibold">Foros de Debate</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Buscador y Acciones</li>
                                <li>Listado de Temas</li>
                                <li>Categorías</li>
                                <li>Actividad Reciente</li>
                            </ul>
                        </li>
                        <li><a href="{{ route('public.archive') }}" class="text-primary-600 hover:underline font-semibold">Archivo Histórico</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Buscador y Filtros</li>
                                <li>Listado de Documentos</li>
                                <li>Documentos Recientes</li>
                            </ul>
                        </li>
                    </ul>
                </div>

                <!-- Legal -->
                <div data-scroll-reveal>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif border-b pb-4">Legal</h2>
                    <ul class="mt-4 space-y-2 list-disc list-inside">
                        <li><a href="{{ route('privacy-policy') }}" class="text-primary-600 hover:underline font-semibold">Política de Privacidad</a></li>
                        <li><a href="{{ route('terms-of-service') }}" class="text-primary-600 hover:underline font-semibold">Términos de Servicio</a></li>
                    </ul>
                </div>

                <!-- Otros -->
                <div data-scroll-reveal>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif border-b pb-4">Otros</h2>
                    <ul class="mt-4 space-y-2 list-disc list-inside">
                        <li><a href="{{ route('public.sitemap') }}" class="text-primary-600 hover:underline font-semibold">Mapa del Sitio (Esta Página)</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection