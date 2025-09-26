@extends('layouts.public')

@section('title', 'Política de Privacidad')

@section('content')
    <x-public.hero 
        title="Política de Privacidad" 
        subtitle="Tu privacidad es importante para nosotros."
        imageUrl="https://picsum.photos/seed/privacy-hero/1920/1080"
    />

    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-4xl px-6 lg:px-8 bg-white p-8 rounded-lg shadow-lg" data-scroll-reveal>
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-8" role="alert">
                <p class="font-bold">Aviso Importante para el Usuario:</p>
                <p class="mb-2">Esta Política de Privacidad ha sido cuidadosamente adaptada para cumplir con las directrices y principios establecidos en el</p>
                <p class="font-bold"><em>"Reglamento Especial para las Publicaciones de Páginas Web, Uso del Correo Electrónico y Publicaciones Electrónicas"</em> de la Gran Logia de la República de Venezuela. Su propósito es garantizar la confidencialidad y el correcto manejo de la información dentro de un marco de respeto y legalidad masónica.</p>
            </div>

            <div class="prose prose-lg text-gray-700 mx-auto mt-8">
                <h2 class="mb-4">1. Información que Recopilamos</h2>
                <p class="mb-4">Recopilamos información de diversas maneras, incluyendo:</p>
                <ul class="ml-4">
                    <li class="mb-2"><strong>Información que nos proporcionas directamente:</strong> Por ejemplo, al registrarte en áreas privadas del sitio o contactarnos. Esto puede incluir tu nombre, dirección de correo electrónico, etc., para fines de comunicación interna.</li>
                    <li class="mb-2"><strong>Información recopilada automáticamente:</strong> Como tu dirección IP, tipo de navegador y páginas visitadas, para mejorar la funcionalidad del sitio.</li>
                </ul>

                <h2 class="mt-8 mb-4">2. Cómo Utilizamos tu Información</h2>
                <p class="mb-4">Utilizamos la información recopilada para:</p>
                <ul class="ml-4">
                    <li class="mb-2">Proveer, operar y mantener nuestra plataforma.</li>
                    <li class="mb-2">Mejorar y personalizar tu experiencia de usuario.</li>
                    <li class="mb-2">Comunicarnos contigo para asuntos oficiales de la orden.</li>
                    <li class="mb-2">Cumplir con las disposiciones del marco legal masónico vigente.</li>
                </ul>

                <h2 class="mt-8 mb-4">3. Confidencialidad y Divulgación de tu Información</h2>
                <p class="mb-4">En concordancia con el ordenamiento jurídico masónico, la identidad y los datos de nuestros miembros son confidenciales.</p>
                <ul class="ml-4">
                    <li class="mb-2">No compartimos tu información personal con terceros o el público en general.</li>
                    <li class="mb-2">Está prohibido divulgar el nombre de cualquier miembro o revelar el ingreso de un profano a la Orden.</li>
                    <li class="mb-2">La información solo se utilizará para comunicaciones oficiales dentro del marco de la Gran Logia de la República de Venezuela y con tu consentimiento previo.</li>
                </ul>

                <h2 class="mt-8 mb-4">4. Tus Derechos de Protección de Datos</h2>
                <p class="mb-4">Tienes derecho a acceder, corregir o solicitar la eliminación de tu información personal de nuestros registros, contactando a los administradores de esta plataforma.</p>

                <h2 class="mt-8 mb-4">5. Cambios a esta Política de Privacidad</h2>
                <p class="mb-4">Podemos actualizar nuestra Política de Privacidad para mantenerla alineada con las regulaciones de la Gran Logia. Te notificaremos cualquier cambio publicando la nueva política en esta página.</p>

                <h2 class="mt-8 mb-4">6. Contacto</h2>
                <p class="mb-4">Si tienes alguna pregunta sobre esta Política de Privacidad, por favor contáctanos a través de nuestro formulario de contacto.</p>
            </div>
        </div>
    </div>
@endsection