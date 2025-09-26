@extends('layouts.public')

@section('title', 'Términos de Servicio')

@section('content')
    <x-public.hero 
        title="Términos de Servicio" 
        subtitle="Condiciones de uso de nuestro sitio web."
        imageUrl="https://picsum.photos/seed/terms-hero/1920/1080"
    />

    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-4xl px-6 lg:px-8 bg-white p-8 rounded-lg shadow-lg" data-scroll-reveal>
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-8" role="alert">
                <p class="font-bold">Aviso Importante para el Usuario:</p>
                <p class="mb-2">Al utilizar este sitio web, usted acepta cumplir con los términos aquí descritos, los cuales están fundamentados en el</p>
                <p class="font-bold"><em>"Reglamento Especial para las Publicaciones de Páginas Web, Uso del Correo Electrónico y Publicaciones Electrónicas"</em> de la Gran Logia de la República de Venezuela. Estas condiciones buscan preservar la integridad, el respeto y los principios de nuestra orden en el entorno digital.</p>
            </div>

            <div class="prose prose-lg text-gray-700 mx-auto mt-8">
                <h2 class="mb-4">1. Aceptación de los Términos</h2>
                <p class="mb-4">Al acceder y utilizar este sitio web, aceptas estar sujeto a estos Términos de Servicio y al Reglamento Especial para las Publicaciones de Páginas Web, Uso del Correo Electrónico y Publicaciones Electrónicas de la Gran Logia de la República de Venezuela. Si no estás de acuerdo, se te prohíbe usar o acceder a este sitio.</p>

                <h2 class="mt-8 mb-4">2. Licencia de Uso</h2>
                <p class="mb-4">Se concede permiso para visualizar los materiales de este sitio para uso personal y no comercial. Bajo esta licencia no podrás:</p>
                <ul class="ml-4">
                    <li class="mb-2">Modificar o copiar los materiales.</li>
                    <li class="mb-2">Utilizar los materiales para fines comerciales o exhibición pública no autorizada.</li>
                    <li class="mb-2">Publicar contenido que revele los secretos de la orden, como signos, palabras, tocamientos o rituales.</li>
                    <li class="mb-2">Utilizar la plataforma para fines de proselitismo político y/o religioso.</li>
                    <li class="mb-2">Publicar, distribuir o divulgar cualquier información o material inapropiado, difamatorio, ilícito u obsceno.</li>
                    <li class="mb-2">Usar esta plataforma para difamar, insultar, amenazar o infringir los derechos de terceros.</li>
                    <li class="mb-2">Transferir los materiales a otra persona o "reflejar" los materiales en cualquier otro servidor.</li>
                </ul>
                <p class="mb-4">Esta licencia terminará automáticamente si violas cualquiera de estas restricciones.</p>

                <h2 class="mt-8 mb-4">3. Descargo de Responsabilidad</h2>
                <p class="mb-4">Los materiales en el sitio web se proporcionan "tal cual". De acuerdo con el Art. 14° del Reglamento, se establece que: "El contenido de cualquier artículo, y/o material [...] es la opinión, o las opiniones de los autores, y no es de manera alguna interpretado como de la autoridad Francmasónica en General o de una Logia en particular [...] tampoco significa la opinión de la Gran Logia de la República de Venezuela".</p>

                <h2 class="mt-8 mb-4">4. Limitaciones</h2>
                <p class="mb-4">En ningún caso seremos responsables de ningún daño que surja del uso o la imposibilidad de usar los materiales en el sitio web, incluyendo cualquier acción derivada de la violación de este reglamento o del Estatuto Penal Masónico.</p>

                <h2 class="mt-8 mb-4">5. Enlaces</h2>
                <p class="mb-4">Los hipervínculos a otros sitios son permitidos siempre que no ofendan la moral, las buenas costumbres o contengan ofensas sobre política, raza o religión. No somos responsables del contenido de ningún sitio vinculado.</p>

                <h2 class="mt-8 mb-4">6. Modificaciones</h2>
                <p class="mb-4">Podemos revisar estos Términos de Servicio en cualquier momento para alinearlos con las directrices de la Gran Logia de la República de Venezuela.</p>

                <h2 class="mt-8 mb-4">7. Ley Aplicable</h2>
                <p class="mb-4">Estos términos se rigen e interpretan de acuerdo con las leyes de la República Bolivariana de Venezuela y el marco legal de la Gran Logia de la República de Venezuela.</p>
            </div>
        </div>
    </div>
@endsection