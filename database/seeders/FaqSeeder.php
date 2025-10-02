<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => '¿Qué es la Masonería?',
                'answer' => 'La Masonería es una de las fraternidades más antiguas y grandes del mundo. Es una institución filosófica, filantrópica y progresista, que tiene como objetivo la búsqueda de la verdad, el estudio de la moral y la práctica de la solidaridad. Trabaja por el mejoramiento material y moral de la humanidad, y su perfeccionamiento intelectual y social.',
                'category' => 'General',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'question' => '¿La Masonería es una religión?',
                'answer' => 'No. La Masonería no es una religión ni un sustituto de ella. Requiere que sus miembros crean en un Ser Supremo, al que se refieren como el "Gran Arquitecto del Universo", pero no impone dogmas ni está afiliada a ninguna religión en particular. La discusión sobre temas religiosos sectarios está prohibida en las logias.',
                'category' => 'General',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'question' => '¿Cuáles son los orígenes de la Masonería?',
                'answer' => 'Los orígenes de la masonería moderna, o "especulativa", se remontan a las cofradías de canteros y constructores de catedrales de la Edad Media (masonería "operativa"). La primera Gran Logia se fundó en Londres en 1717, marcando el inicio de la masonería tal como la conocemos hoy.',
                'category' => 'Historia',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'question' => '¿Qué es una logia masónica?',
                'answer' => 'Una logia es el cuerpo básico en el que se organizan los masones. El término se refiere tanto al grupo de personas que la componen como al lugar físico donde se reúnen. Es en la logia donde se realizan los trabajos masónicos, se inician nuevos miembros y se fomenta la fraternidad.',
                'category' => 'Estructura',
                'is_active' => true,
                'order' => 4,
            ],
            [
                'question' => '¿Qué hacen los masones en sus reuniones?',
                'answer' => 'Las reuniones, llamadas "tenidas", consisten en la ejecución de rituales que utilizan un lenguaje simbólico para enseñar principios morales y filosóficos. También se tratan asuntos administrativos de la logia, se presentan trabajos o ponencias sobre diversos temas y se fomenta el compañerismo.',
                'category' => 'Actividades',
                'is_active' => true,
                'order' => 5,
            ],
            [
                'question' => '¿Quién puede ser masón y cómo se ingresa?',
                'answer' => 'Para ser masón se requiere ser un hombre libre, mayor de edad, de buena reputación, con solvencia moral y económica, y creer en un principio superior o causa primera, usualmente referido como el Gran Arquitecto del Universo. El ingreso es voluntario y requiere ser aceptado por los miembros de una logia tras un proceso de entrevistas y votación.',
                'category' => 'Membresía',
                'is_active' => true,
                'order' => 6,
            ],
            [
                'question' => '¿La Masonería es una sociedad secreta?',
                'answer' => 'No, es una sociedad discreta. Sus lugares de reunión son conocidos y en muchos países figura en registros públicos. Lo que se mantiene con discreción son los modos de reconocimiento entre sus miembros y los detalles de sus ceremonias, que forman parte de la experiencia personal de cada masón.',
                'category' => 'General',
                'is_active' => true,
                'order' => 7,
            ],
            [
                'question' => '¿Los masones se dedican a la política?',
                'answer' => 'La Masonería como institución no interviene en asuntos de política partidista ni promueve candidaturas. Sin embargo, alienta a sus miembros a ser ciudadanos activos y responsables, y a participar en la sociedad de acuerdo con sus conciencias y principios masónicos de libertad, igualdad y fraternidad.',
                'category' => 'General',
                'is_active' => true,
                'order' => 8,
            ],
            [
                'question' => '¿Qué significa el "Gran Arquitecto del Universo"?',
                'answer' => 'Es un término simbólico que utilizan los masones para referirse al Ser Supremo o a un principio creador. Permite que hombres de diferentes religiones y creencias espirituales puedan reunirse bajo un concepto común sin entrar en disputas teológicas.',
                'category' => 'Filosofía',
                'is_active' => true,
                'order' => 9,
            ],
            [
                'question' => '¿Por qué se usan símbolos en la Masonería?',
                'answer' => 'La Masonería utiliza símbolos, principalmente herramientas de construcción, como un método de enseñanza. Los símbolos permiten transmitir ideas complejas de moralidad, filosofía y desarrollo personal de una manera universal que trasciende el lenguaje y la cultura.',
                'category' => 'Filosofía',
                'is_active' => true,
                'order' => 10,
            ],
            [
                'question' => '¿Cuál es el papel de la mujer en la Masonería?',
                'answer' => 'Tradicionalmente, la masonería regular está compuesta por hombres. Sin embargo, existen obediencias masónicas femeninas y mixtas que son reconocidas por algunas corrientes masónicas, aunque no por todas. La Gran Logia de la República de Venezuela, a la que pertenece la Gran Zona 5, es una obediencia masculina.',
                'category' => 'Estructura',
                'is_active' => true,
                'order' => 11,
            ],
            [
                'question' => '¿Qué son los ritos masónicos?',
                'answer' => 'Un rito masónico es un conjunto coherente de rituales y ceremonias que estructuran los trabajos en la logia. Existen varios ritos, como el Rito Escocés Antiguo y Aceptado o el Rito de York. Cada uno tiene sus propias particularidades, pero todos comparten los principios fundamentales de la Masonería.',
                'category' => 'Estructura',
                'is_active' => true,
                'order' => 12,
            ],
            [
                'question' => '¿Qué tipo de caridad hacen los masones?',
                'answer' => 'La filantropía es un pilar de la Masonería. Las logias y Grandes Logias patrocinan una amplia variedad de obras benéficas, desde hospitales y escuelas hasta programas de ayuda para viudas y huérfanos de masones y para la comunidad en general.',
                'category' => 'Actividades',
                'is_active' => true,
                'order' => 13,
            ],
            [
                'question' => '¿Cuánto cuesta ser masón?',
                'answer' => 'Existen costos asociados a la membresía, que incluyen una cuota de iniciación y cuotas periódicas (mensuales o anuales). Estos fondos se utilizan para el mantenimiento de la logia, actividades y contribuciones a obras de caridad. El monto varía significativamente de una logia a otra.',
                'category' => 'Membresía',
                'is_active' => true,
                'order' => 14,
            ],
            [
                'question' => '¿Qué es un mandil masónico?',
                'answer' => 'El mandil es una de las insignias más importantes de un masón. Simboliza el trabajo y la pureza. Deriva de los mandiles de cuero que usaban los canteros medievales para protegerse. Su decoración varía según el grado y el cargo del masón.',
                'category' => 'Simbología',
                'is_active' => true,
                'order' => 15,
            ],
            [
                'question' => '¿Existen diferentes ramas de la Masonería?',
                'answer' => 'Sí. La masonería se divide principalmente en dos corrientes: la "regular", que exige a sus miembros la creencia en un Ser Supremo y no admite mujeres, y la "liberal" o "adogmática", que suele ser más flexible en estos requisitos, aceptando a menudo a agnósticos y permitiendo logias mixtas o femeninas.',
                'category' => 'Estructura',
                'is_active' => true,
                'order' => 16,
            ],
            [
                'question' => '¿Qué es la regularidad masónica?',
                'answer' => 'La "regularidad" es un concepto complejo que se refiere al reconocimiento mutuo entre Grandes Logias basado en el cumplimiento de ciertos principios y antiguas normas (landmarks), como la creencia en el Gran Arquitecto del Universo, la presencia de las Tres Grandes Luces (Libro de la Ley Sagrada, Escuadra y Compás) en la logia, y la prohibición de discutir sobre política y religión.',
                'category' => 'Estructura',
                'is_active' => true,
                'order' => 17,
            ],
            [
                'question' => '¿Se puede dejar de ser masón?',
                'answer' => 'Sí. La membresía en la Masonería es voluntaria. Un miembro puede renunciar en cualquier momento si así lo desea. Dejar la orden no conlleva ninguna consecuencia negativa más allá de la pérdida de los privilegios de membresía.',
                'category' => 'Membresía',
                'is_active' => true,
                'order' => 18,
            ],
            [
                'question' => '¿Qué beneficios personales se obtienen al ser masón?',
                'answer' => 'La Masonería ofrece un camino de autoconocimiento y desarrollo personal. Proporciona herramientas para mejorar el carácter, practicar la moral, desarrollar habilidades de liderazgo y oratoria, y construir amistades duraderas con personas de ideas afines en un ambiente de fraternidad y confianza.',
                'category' => 'General',
                'is_active' => true,
                'order' => 19,
            ],
            [
                'question' => '¿Qué son los grados en la Masonería?',
                'answer' => 'La Masonería simbólica o azul, que es la base de toda la masonería, se estructura en tres grados: Aprendiz, Compañero y Maestro Masón. Estos grados representan un progreso en el conocimiento y un viaje personal de desarrollo moral e intelectual. Existen otros cuerpos masónicos que otorgan grados superiores o colaterales, pero el de Maestro Masón es el más alto en la logia simbólica.',
                'category' => 'Grados',
                'is_active' => true,
                'order' => 20,
            ],
        ];

        // Limpia la tabla antes de insertar nuevos datos para evitar duplicados
        Faq::truncate();

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
