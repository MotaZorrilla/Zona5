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
        // Obtener el primer usuario o crear uno por defecto
        $user = User::first() ?: User::create([
            'name' => 'Administrador',
            'email' => 'admin@granzona5.org',
            'password' => bcrypt('password'),
        ]);

        $forums = [
            [
                'title' => 'Discusiones Generales',
                'description' => 'Foro para temas generales de interés masónico y debates abiertos.',
                'category' => 'General',
                'is_active' => true,
                'is_pinned' => true,
                'order' => 1,
                'created_by' => $user->id,
            ],
            [
                'title' => 'Estudios Masónicos',
                'description' => 'Espacio dedicado al estudio y análisis de temas filosóficos y simbólicos.',
                'category' => 'Estudios',
                'is_active' => true,
                'is_pinned' => false,
                'order' => 2,
                'created_by' => $user->id,
            ],
            [
                'title' => 'Actividades y Eventos',
                'description' => 'Información y coordinación de actividades, tenidas y eventos especiales.',
                'category' => 'Actividades',
                'is_active' => true,
                'is_pinned' => false,
                'order' => 3,
                'created_by' => $user->id,
            ],
            [
                'title' => 'Preguntas y Respuestas',
                'description' => 'Espacio para resolver dudas y compartir conocimientos entre hermanos.',
                'category' => 'Apoyo',
                'is_active' => true,
                'is_pinned' => false,
                'order' => 4,
                'created_by' => $user->id,
            ],
        ];

        foreach ($forums as $forumData) {
            $forum = Forum::create($forumData);

            // Crear algunos posts de ejemplo para cada foro
            $this->createSamplePosts($forum, $user);
        }
    }

    /**
     * Crear posts de ejemplo para un foro.
     */
    private function createSamplePosts(Forum $forum, User $user)
    {
        $posts = [
            [
                'title' => 'Bienvenidos al foro ' . $forum->title,
                'content' => 'Este es el primer post de este foro. Aquí puedes compartir ideas, hacer preguntas y participar en discusiones constructivas con otros hermanos masones.',
                'author_id' => $user->id,
                'is_pinned' => true,
                'is_approved' => true,
            ],
        ];

        // Agregar posts adicionales dependiendo del foro
        switch ($forum->category) {
            case 'General':
                $posts[] = [
                    'title' => 'Recomendaciones de lecturas masónicas',
                    'content' => '¿Cuáles son los libros que más os han impactado en vuestro camino masónico? Me gustaría conocer vuestras recomendaciones.',
                    'author_id' => $user->id,
                    'is_pinned' => false,
                    'is_approved' => true,
                ];
                break;
            case 'Estudios':
                $posts[] = [
                    'title' => 'Análisis del simbolismo del templo',
                    'content' => 'Me gustaría discutir sobre la importancia del simbolismo arquitectónico en la masonería. ¿Qué elementos os parecen más relevantes?',
                    'author_id' => $user->id,
                    'is_pinned' => false,
                    'is_approved' => true,
                ];
                break;
            case 'Actividades':
                $posts[] = [
                    'title' => 'Próxima tenida especial',
                    'content' => 'Informamos que el próximo sábado 15 de octubre tendremos una tenida especial de elevación. Todos los hermanos están cordialmente invitados.',
                    'author_id' => $user->id,
                    'is_pinned' => false,
                    'is_approved' => true,
                ];
                break;
        }

        foreach ($posts as $postData) {
            ForumPost::create($postData + ['forum_id' => $forum->id]);
        }
    }
}