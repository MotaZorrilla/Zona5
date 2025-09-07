@extends('layouts.public')

@section('title', 'Términos de Servicio')

@section('content')
    <x-public.hero 
        title="Términos de Servicio" 
        subtitle="Condiciones de uso de nuestro sitio web."
        imageUrl="https://picsum.photos/seed/terms-hero/1920/1080"
    />

    <div class="py-24 sm:py-32">
        <div class="mx-auto max-w-4xl px-6 lg:px-8 bg-white p-8 rounded-lg shadow-lg">
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-8" role="alert">
                <p class="font-bold">Aviso Importante:</p>
                <p>Este es un texto de ejemplo para los Términos de Servicio. Es crucial que consultes a un profesional legal para redactar unos términos que cumplan con todas las leyes y regulaciones aplicables a tu jurisdicción y a la naturaleza de tu sitio web.</p>
            </div>

            <div class="prose prose-lg text-gray-700 mx-auto mt-8">
                <h2 class="mb-4">1. Aceptación de los Términos</h2>
                <p class="mb-4">Al acceder y utilizar este sitio web, aceptas estar sujeto a estos Términos de Servicio, a todas las leyes y regulaciones aplicables, y aceptas que eres responsable del cumplimiento de las leyes locales aplicables. Si no estás de acuerdo con alguno de estos términos, se te prohíbe usar o acceder a este sitio.</p>

                <h2 class="mt-8 mb-4">2. Licencia de Uso</h2>
                <p class="mb-4">Se concede permiso para descargar temporalmente una copia de los materiales (información o software) en el sitio web para visualización transitoria personal y no comercial solamente. Esta es la concesión de una licencia, no una transferencia de título, y bajo esta licencia no podrás:</p>
                <ul class="ml-4">
                    <li class="mb-2">Modificar o copiar los materiales.</li>
                    <li class="mb-2">Utilizar los materiales para cualquier propósito comercial, o para cualquier exhibición pública (comercial o no comercial).</li>
                    <li class="mb-2">Intentar descompilar o aplicar ingeniería inversa a cualquier software contenido en el sitio web.</li>
                    <li class="mb-2">Eliminar cualquier derecho de autor u otras anotaciones de propiedad de los materiales.</li>
                    <li class="mb-2">Transferir los materiales a otra persona o "reflejar" los materiales en cualquier otro servidor.</li>
                </ul>
                <p class="mb-4">Esta licencia terminará automáticamente si violas cualquiera de estas restricciones y podrá ser terminada por nosotros en cualquier momento.</p>

                <h2 class="mt-8 mb-4">3. Descargo de Responsabilidad</h2>
                <p class="mb-4">Los materiales en el sitio web se proporcionan "tal cual". No ofrecemos garantías, expresas o implícitas, y por la presente renunciamos y negamos todas las demás garantías, incluyendo, sin limitación, garantías implícitas o condiciones de comerciabilidad, idoneidad para un propósito particular o no infracción de la propiedad intelectual u otra violación de derechos.</p>

                <h2 class="mt-8 mb-4">4. Limitaciones</h2>
                <p class="mb-4">En ningún caso seremos responsables de ningún daño (incluyendo, sin limitación, daños por pérdida de datos o ganancias, o debido a la interrupción del negocio) que surjan del uso o la imposibilidad de usar los materiales en el sitio web, incluso si hemos sido notificados oralmente o por escrito de la posibilidad de dicho daño.</p>

                <h2 class="mt-8 mb-4">5. Precisión de los Materiales</h2>
                <p class="mb-4">Los materiales que aparecen en el sitio web podrían incluir errores técnicos, tipográficos o fotográficos. No garantizamos que ninguno de los materiales en su sitio web sea preciso, completo o actual. Podemos realizar cambios en los materiales contenidos en su sitio web en cualquier momento sin previo aviso.</p>

                <h2 class="mt-8 mb-4">6. Enlaces</h2>
                <p class="mb-4">No hemos revisado todos los sitios vinculados a nuestro sitio web y no somos responsables del contenido de ningún sitio vinculado. La inclusión de cualquier enlace no implica aprobación por nuestra parte del sitio. El uso de cualquier sitio web vinculado es bajo el propio riesgo del usuario.</p>

                <h2 class="mt-8 mb-4">7. Modificaciones</h2>
                <p class="mb-4">Podemos revisar estos Términos de Servicio para nuestro sitio web en cualquier momento sin previo aviso. Al usar este sitio web, aceptas estar sujeto a la versión actual de estos Términos de Servicio.</p>

                <h2 class="mt-8 mb-4">8. Ley Aplicable</h2>
                <p class="mb-4">Estos términos y condiciones se rigen e interpretan de acuerdo con las leyes de [Tu Jurisdicción] y te sometes irrevocablemente a la jurisdicción exclusiva de los tribunales de ese estado o ubicación.</p>
            </div>
        </div>
    </div>
@endsection