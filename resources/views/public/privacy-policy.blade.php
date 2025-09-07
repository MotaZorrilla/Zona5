@extends('layouts.public')

@section('title', 'Política de Privacidad')

@section('content')
    <x-public.hero 
        title="Política de Privacidad" 
        subtitle="Tu privacidad es importante para nosotros."
        imageUrl="https://picsum.photos/seed/privacy-hero/1920/1080"
    />

    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-4xl px-6 lg:px-8 bg-white p-8 rounded-lg shadow-lg">
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-8" role="alert">
                <p class="font-bold">Aviso Importante:</p>
                <p>Este es un texto de ejemplo para la Política de Privacidad. Es crucial que consultes a un profesional legal para redactar una política de privacidad que cumpla con todas las leyes y regulaciones aplicables a tu jurisdicción y a la naturaleza de tu sitio web.</p>
            </div>

            <div class="prose prose-lg text-gray-700 mx-auto mt-8">
                <h2 class="mb-4">1. Información que Recopilamos</h2>
                <p class="mb-4">Recopilamos información de diversas maneras, incluyendo:</p>
                <ul class="ml-4">
                    <li class="mb-2"><strong>Información que nos proporcionas directamente:</strong> Por ejemplo, cuando te registras en nuestro sitio, te suscribes a un boletín, o nos contactas a través de formularios. Esto puede incluir tu nombre, dirección de correo electrónico, número de teléfono, etc.</li>
                    <li class="mb-2"><strong>Información recopilada automáticamente:</strong> Cuando visitas nuestro sitio web, podemos recopilar cierta información automáticamente de tu dispositivo, como tu dirección IP, tipo de navegador, sistema operativo, páginas visitadas, etc.</li>
                </ul>

                <h2 class="mt-8 mb-4">2. Cómo Utilizamos tu Información</h2>
                <p class="mb-4">Utilizamos la información recopilada para:</p>
                <ul class="ml-4">
                    <li class="mb-2">Proveer, operar y mantener nuestro sitio web.</li>
                    <li class="mb-2">Mejorar, personalizar y expandir nuestro sitio web.</li>
                    <li class="mb-2">Comprender y analizar cómo utilizas nuestro sitio web.</li>
                    <li class="mb-2">Desarrollar nuevos productos, servicios, características y funcionalidades.</li>
                    <li class="mb-2">Comunicarnos contigo, ya sea directamente o a través de uno de nuestros socios, incluyendo para servicio al cliente, para proporcionarte actualizaciones y otra información relacionada con el sitio web, y para fines de marketing y promoción.</li>
                </ul>

                <h2 class="mt-8 mb-4">3. Compartir tu Información</h2>
                <p class="mb-4">No compartimos tu información personal con terceros, excepto en las siguientes circunstancias:</p>
                <ul class="ml-4">
                    <li class="mb-2">Con tu consentimiento.</li>
                    <li class="mb-2">Para cumplir con una obligación legal.</li>
                    <li class="mb-2">Para proteger y defender nuestros derechos o propiedad.</li>
                </ul>

                <h2 class="mt-8 mb-4">4. Tus Derechos de Protección de Datos</h2>
                <p class="mb-4">Tienes ciertos derechos con respecto a tu información personal, incluyendo el derecho a acceder, corregir, actualizar o solicitar la eliminación de tu información personal.</p>

                <h2 class="mt-8 mb-4">5. Cambios a esta Política de Privacidad</h2>
                <p class="mb-4">Podemos actualizar nuestra Política de Privacidad de vez en cuando. Te notificaremos cualquier cambio publicando la nueva Política de Privacidad en esta página.</p>

                <h2 class="mt-8 mb-4">6. Contacto</h2>
                <p class="mb-4">Si tienes alguna pregunta sobre esta Política de Privacidad, por favor contáctanos a través de nuestro formulario de contacto.</p>
            </div>
        </div>
    </div>
@endsection