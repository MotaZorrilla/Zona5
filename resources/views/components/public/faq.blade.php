<div class="bg-gray-50">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 font-serif">Preguntas Frecuentes</h2>
            <p class="mt-4 text-lg text-gray-500">Respuestas a algunas de las dudas más comunes sobre la Francmasonería.</p>
        </div>
        <div class="mt-12">
            <div x-data="{
                faqs: [
                    {
                        id: 1,
                        question: '¿Qué es la Masonería?',
                        answer: 'La Francmasonería es una de las fraternidades más antiguas y grandes del mundo. Es una institución filantrópica, filosófica y progresista que busca el desarrollo moral e intelectual del ser humano, promoviendo la fraternidad entre sus miembros y la caridad hacia toda la humanidad.',
                        open: false
                    },
                    {
                        id: 2,
                        question: '¿Es la Masonería una religión o una secta?',
                        answer: 'No. La Masonería no es una religión ni un sustituto de ella. Requiere que sus miembros crean en un Ser Supremo, pero no impone ninguna doctrina teológica específica. Tampoco es una secta, ya que no tiene dogmas y fomenta la libertad de pensamiento de sus miembros.',
                        open: false
                    },
                    {
                        id: 3,
                        question: '¿Es una sociedad secreta?',
                        answer: 'No, es una sociedad discreta. Sus lugares de reunión son conocidos y no oculta su existencia. Lo que se mantiene con discreción son los medios de reconocimiento entre sus miembros y los detalles de sus ceremonias internas, que forman parte de su tradición.',
                        open: false
                    },
                    {
                        id: 4,
                        question: '¿Qué se hace en las reuniones masónicas (Tenidas)?',
                        answer: 'Las reuniones, llamadas Tenidas, se dedican al estudio de temas filosóficos, simbólicos y humanísticos a través de rituales y alegorías. También se tratan asuntos administrativos de la Logia y se fomenta la fraternidad y el compañerismo.',
                        open: false
                    },
                    {
                        id: 5,
                        question: '¿Quién puede ser Masón?',
                        answer: 'Para ser Masón se requiere ser un hombre libre, mayor de edad, de buena reputación y creer en la existencia de un Ser Supremo. No se hacen distinciones por nacionalidad, raza, religión o posición social.',
                        open: false
                    },
                    {
                        id: 6,
                        question: '¿Las mujeres pueden ser Masonas?',
                        answer: 'La masonería tradicional, como la que practica la Gran Logia de la República de Venezuela, es exclusivamente masculina. Sin embargo, existen otras organizaciones y obediencias masónicas a nivel mundial que son femeninas o mixtas.',
                        open: false
                    },
                    {
                        id: 7,
                        question: '¿Cuál es el propósito de los símbolos y rituales?',
                        answer: 'Los símbolos y rituales son herramientas pedagógicas. Utilizan alegorías basadas en el antiguo arte de la construcción para transmitir principios morales y éticos, invitando a la reflexión personal y al autoconocimiento.',
                        open: false
                    },
                    {
                        id: 8,
                        question: '¿La Masonería está en contra de la Iglesia Católica?',
                        answer: 'Históricamente ha habido conflictos, pero la Masonería no está en contra de ninguna religión. Promueve la tolerancia y el respeto a todas las creencias. La incompatibilidad ha sido declarada por algunas iglesias, no por la Masonería misma.',
                        open: false
                    },
                    {
                        id: 9,
                        question: '¿Qué beneficios obtiene un Masón?',
                        answer: 'El principal beneficio es el crecimiento personal en un ambiente de fraternidad y estudio. Ofrece herramientas para el desarrollo ético, intelectual y espiritual, además de una red de hermandad basada en la confianza y la ayuda mutua.',
                        open: false
                    },
                    {
                        id: 10,
                        question: '¿Cómo puedo unirme?',
                        answer: 'Tradicionalmente, para unirse se debe ser invitado por un miembro. Sin embargo, si no conoce a ningún masón, puede utilizar nuestro formulario de contacto para expresar su interés de manera formal y discreta. Su solicitud será canalizada adecuadamente.',
                        open: false
                    }
                ],
                toggle(faq) {
                    this.faqs.forEach(f => {
                        if (f.id === faq.id) {
                            f.open = !f.open;
                        } else {
                            f.open = false;
                        }
                    });
                }
            }">
                <dl class="space-y-4">
                    <template x-for="faq in faqs" :key="faq.id">
                        <div class="border border-gray-200 rounded-lg p-4" data-scroll-reveal>
                            <dt>
                                <button @click="toggle(faq)" class="w-full flex justify-between items-center text-left text-gray-700">
                                    <span class="text-base font-medium" x-text="faq.question"></span>
                                    <span class="ml-6 h-7 flex items-center">
                                        <i class="ri-arrow-down-s-line transition-transform duration-300" :class="{ '-rotate-180': faq.open }"></i>
                                    </span>
                                </button>
                            </dt>
                            <dd x-show="faq.open" x-collapse class="mt-4 pr-12">
                                <p class="text-base text-gray-500" x-text="faq.answer"></p>
                            </dd>
                        </div>
                    </template>
                </dl>
            </div>
        </div>
    </div>
</div>
