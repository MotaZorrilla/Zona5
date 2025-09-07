@extends('layouts.public')

@section('title', 'Mapa del Sitio')

@section('content')
    <x-public.hero 
        title="Mapa del Sitio" 
        subtitle="Encuentra todo nuestro contenido en un solo lugar."
        imageUrl="https://picsum.photos/seed/sitemap-hero/1920/1080"
    />

    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-4xl px-6 lg:px-8">
            <div class="space-y-12">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif border-b pb-4">Páginas Principales</h2>
                    <ul class="mt-4 space-y-4 list-disc list-inside">
                        <li>
                            <a href="{{ route('welcome') }}" class="text-primary-600 hover:underline font-semibold">Inicio</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Nuestros Pilares</li>
                                <li>Últimas Noticias y Eventos</li>
                                <li>Preguntas Frecuentes</li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('public.about-us') }}" class="text-primary-600 hover:underline font-semibold">Quiénes Somos</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Nuestra Historia</li>
                                <li>Misión y Visión</li>
                                <li>Nuestros Valores</li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('public.lodges') }}" class="text-primary-600 hover:underline font-semibold">Logias</a>
                            <ul class="pl-6 mt-2 space-y-1 list-disc list-inside text-gray-700">
                                <li>Logias de Ciudad Guayana</li>
                                <li>Logias de Upata</li>
                                <li>Logias de Ciudad Bolívar</li>
                            </ul>
                        </li>
                        <li><a href="{{ route('public.news') }}" class="text-primary-600 hover:underline font-semibold">Noticias</a></li>
                        <li><a href="{{ route('public.contact') }}" class="text-primary-600 hover:underline font-semibold">Contacto</a></li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif border-b pb-4">Recursos</h2>
                    <ul class="mt-4 space-y-2 list-disc list-inside">
                        <li><a href="{{ route('public.school') }}" class="text-primary-600 hover:underline">Escuela Virtual</a></li>
                        <li><a href="{{ route('public.forums') }}" class="text-primary-600 hover:underline">Foros</a></li>
                        <li><a href="{{ route('public.archive') }}" class="text-primary-600 hover:underline">Archivo Histórico</a></li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-gray-900 font-serif border-b pb-4">Legal</h2>
                    <ul class="mt-4 space-y-2 list-disc list-inside">
                        <li><a href="{{ route('privacy-policy') }}" class="text-primary-600 hover:underline">Política de Privacidad</a></li>
                        <li><a href="{{ route('terms-of-service') }}" class="text-primary-600 hover:underline">Términos de Servicio</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
