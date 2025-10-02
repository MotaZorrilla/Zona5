<?php

namespace Database\Seeders;

use App\Models\Forum;
use App\Models\ForumPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpia la tabla para evitar duplicados
        Forum::query()->delete();
        ForumPost::query()->delete();

        // Obtener el primer usuario o crear uno por defecto
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin Fundador',
                'email' => 'admin@example.com',
            ]);
        }

        $forums = [
            [
                'title' => 'Discusiones Generales',
                'description' => 'Foro para temas generales de interés masónico y debates abiertos sobre la Orden en el mundo moderno.',
                'category' => 'General',
                'is_active' => true,
                'is_pinned' => true,
                'order' => 1,
                'created_by' => $user->id,
            ],
            [
                'title' => 'Filosofía y Ética Masónica',
                'description' => 'Análisis de los principios filosóficos y éticos que sustentan a la Masonería. Un espacio para la reflexión profunda.',
                'category' => 'Estudios',
                'is_active' => true,
                'is_pinned' => true,
                'order' => 2,
                'created_by' => $user->id,
            ],
            [
                'title' => 'Simbolismo y Ritualística',
                'description' => 'Estudio e interpretación de los símbolos, alegorías y rituales de los tres grados simbólicos.',
                'category' => 'Estudios',
                'is_active' => true,
                'is_pinned' => false,
                'order' => 3,
                'created_by' => $user->id,
            ],
            [
                'title' => 'Historia de la Masonería',
                'description' => 'Investigación y debate sobre los orígenes, evolución e impacto de la Masonería a lo largo de la historia.',
                'category' => 'Historia',
                'is_active' => true,
                'is_pinned' => false,
                'order' => 4,
                'created_by' => $user->id,
            ],
            [
                'title' => 'Masonería y Sociedad',
                'description' => 'Discusión sobre el rol del masón en la sociedad contemporánea y las contribuciones de la Orden al progreso social.',
                'category' => 'Actualidad',
                'is_active' => true,
                'is_pinned' => false,
                'order' => 5,
                'created_by' => $user->id,
            ],
            [
                'title' => 'Administración y Vida de la Logia',
                'description' => 'Espacio para compartir mejores prácticas sobre la administración de una logia, organización de eventos y fomento de la fraternidad.',
                'category' => 'Gestión',
                'is_active' => true,
                'is_pinned' => false,
                'order' => 6,
                'created_by' => $user->id,
            ],
        ];

        foreach ($forums as $forumData) {
            $forum = Forum::create($forumData);
            $this->createSamplePosts($forum, $user);
        }
    }

    /**
     * Crear posts de ejemplo para un foro.
     */
    private function createSamplePosts(Forum $forum, User $user)
    {
        $posts = [];

        switch ($forum->title) {
            case 'Discusiones Generales':
                $posts = [
                    [
                        'title' => 'Bienvenidos a los Foros de la Gran Zona 5',
                        'content' => 'QQ.`.`HH.`.`, este es un espacio para el diálogo fraterno y constructivo. Os invitamos a participar activamente, compartiendo vuestras ideas y conocimientos con respeto y tolerancia. Este primer post sirve como bienvenida y punto de partida.',
                        'is_pinned' => true,
                    ],
                    [
                        'title' => '¿Cómo aplicar los principios masónicos en nuestra vida diaria?',
                        'content' => 'Más allá de nuestros trabajos en logia, ¿de qué manera práctica y tangible aplicáis los principios de Libertad, Igualdad y Fraternidad en vuestro entorno profesional, familiar y social? Compartamos ejemplos que nos inspiren a todos.',
                    ],
                ];
                break;

            case 'Filosofía y Ética Masónica':
                $posts = [
                    [
                        'title' => 'El concepto del "Libre Pensador"',
                        'content' => 'La Masonería nos invita a ser librepensadores. ¿Pero qué significa realmente en el siglo XXI? ¿Se trata solo de cuestionar dogmas o implica una responsabilidad mayor en la construcción de nuestro propio sistema de valores? Abro el debate.',
                    ],
                    [
                        'title' => 'Virtud y Moral: ¿Son conceptos relativos o universales?',
                        'content' => 'A menudo hablamos de la virtud y la moral como pilares de nuestra Orden. Sin embargo, en un mundo cada vez más diverso, ¿podemos seguir hablando de una moral universal? ¿Cómo dialoga la ética masónica con el relativismo cultural?',
                    ],
                ];
                break;

            case 'Simbolismo y Ritualística':
                $posts = [
                    [
                        'title' => 'La Piedra en Bruto: Más allá de la metáfora inicial',
                        'content' => 'Todos conocemos la interpretación básica de la piedra en bruto como el estado imperfecto del Aprendiz. Pero, ¿qué otras capas de significado encontráis en este símbolo? ¿Termina alguna vez de pulirse por completo?',
                    ],
                    [
                        'title' => 'El Ojo que Todo lo Ve: ¿Símbolo de vigilancia divina o de la conciencia?',
                        'content' => 'Este es uno de los símbolos más reconocibles y, a la vez, más malinterpretados. Me gustaría que profundizáramos en su origen y en las diferentes interpretaciones que se le han dado, tanto dentro como fuera de la Orden. ¿Representa al G.`.`A.`.`D.`.`U.`.` o a la conciencia individual que nos juzga?',
                    ],
                ];
                break;

            case 'Historia de la Masonería':
                $posts = [
                    [
                        'title' => 'La influencia de la Ilustración en la Masonería moderna',
                        'content' => 'Se dice que la Masonería es hija de la Ilustración. ¿En qué medida los trabajos de filósofos como Locke, Voltaire o Montesquieu dieron forma a nuestros rituales y principios? ¿Somos herederos directos de ese proyecto intelectual?',
                    ],
                    [
                        'title' => 'Mitos y verdades sobre los Templarios y la Masonería',
                        'content' => 'Es una conexión popular en la cultura general, pero ¿qué bases históricas reales existen para vincular a la Orden del Temple con los orígenes de la Masonería? Separemos el mito de la evidencia documentada.',
                    ],
                ];
                break;

            case 'Masonería y Sociedad':
                $posts = [
                    [
                        'title' => 'El desafío de la Masonería ante la inteligencia artificial y la tecnología',
                        'content' => 'En un mundo dominado por la tecnología y la IA, ¿cuál es el lugar de una tradición humanista como la Masonería? ¿Puede la tecnología ser una herramienta para la fraternidad o representa una amenaza para nuestros principios?',
                    ],
                    [
                        'title' => 'Acciones concretas para mejorar nuestra comunidad',
                        'content' => 'La caridad y la beneficencia son deberes masónicos. Más allá de la ayuda económica, ¿qué proyectos de impacto social podríamos emprender como Gran Zona para dejar una huella positiva y tangible en nuestras comunidades locales?',
                    ],
                ];
                break;

            case 'Administración y Vida de la Logia':
                $posts = [
                    [
                        'title' => 'Ideas para atraer y retener a nuevos miembros',
                        'content' => 'Muchas logias enfrentan el desafío de atraer a las nuevas generaciones. ¿Qué estrategias os han funcionado para presentar la Masonería de una forma relevante y atractiva para los jóvenes, sin sacrificar la esencia de la Orden?',
                    ],
                    [
                        'title' => 'La importancia de la formación continua del Maestro Masón',
                        'content' => 'Alcanzar el tercer grado no es el final del camino, sino el comienzo. ¿Cómo fomentan vuestras logias la formación continua de los Maestros? ¿Existen grupos de estudio, ciclos de conferencias o programas de mentoría que podamos replicar?',
                    ],
                ];
                break;
        }

        foreach ($posts as $postData) {
            ForumPost::create(array_merge($postData, [
                'forum_id' => $forum->id,
                'author_id' => $user->id,
                'is_approved' => true,
            ]));
        }
    }
}
