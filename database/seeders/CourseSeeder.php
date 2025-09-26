<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseSession;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear cursos asíncronos
        $asynchronousCourses = [
            [
                'title' => 'Historia y Filosofía de la Masonería',
                'subtitle' => 'Un recorrido desde los antiguos constructores hasta la masonería especulativa moderna.',
                'description' => 'Este curso explora los orígenes de la masonería operativa y su evolución hacia la masonería especulativa, analizando los fundamentos filosóficos que rigen la Orden.',
                'grade_level' => 'Primer Grado',
                'image_url' => 'https://picsum.photos/seed/school-card1/800/600',
                'instructor_name' => 'V.`.`H.`.` José Martínez',
                'instructor_role' => 'Gran Orador',
                'instructor_image' => 'https://i.pravatar.cc/40?u=asyn1',
                'duration' => 8,
                'status' => 'active',
                'type' => 'asynchronous',
                'link' => '#',
            ],
            [
                'title' => 'Las 7 Artes Liberales y el Compañero',
                'subtitle' => 'Explora la gramática, retórica, lógica, aritmética, geometría, música y astronomía.',
                'description' => 'Un análisis profundo de cómo las 7 Artes Liberales se aplican en el desarrollo espiritual e intelectual del compañero masón.',
                'grade_level' => 'Segundo Grado',
                'image_url' => 'https://picsum.photos/seed/school-card2/800/600',
                'instructor_name' => 'Q.`.`H.`.` Carlos Rodríguez',
                'instructor_role' => 'Experto en Artes Liberales',
                'instructor_image' => 'https://i.pravatar.cc/40?u=asyn2',
                'duration' => 10,
                'status' => 'active',
                'type' => 'asynchronous',
                'link' => '#',
            ],
            [
                'title' => 'Liderazgo y Dirección de Logia',
                'subtitle' => 'Herramientas prácticas para Venerables Maestros y oficiales en la conducción de una logia.',
                'description' => 'Este curso proporciona herramientas para la efectiva dirección de una logia, cubriendo aspectos administrativos, ceremoniales y de liderazgo.',
                'grade_level' => 'Tercer Grado',
                'image_url' => 'https://picsum.photos/seed/school-card3/800/600',
                'instructor_name' => 'R.`.`W.`.` Miguel Hernández',
                'instructor_role' => 'Gran Maestro de Ceremonias',
                'instructor_image' => 'https://i.pravatar.cc/40?u=asyn3',
                'duration' => 12,
                'status' => 'active',
                'type' => 'asynchronous',
                'link' => '#',
            ],
        ];

        foreach ($asynchronousCourses as $course) {
            Course::create($course);
        }

        // Crear un curso para sesiones síncronas
        $synchronousCourse = Course::create([
            'title' => 'Taller de Simbolismo Masónico',
            'subtitle' => 'Análisis profundo de los símbolos fundamentales en los tres grados de la Masonería.',
            'description' => 'Sesiones prácticas donde se explora el simbolismo masónico en profundidad, fomentando la reflexión y el conocimiento.',
            'grade_level' => 'Primer a Tercer Grado',
            'image_url' => 'https://picsum.photos/seed/school-syn/800/600',
            'instructor_name' => 'H.`.` W.`.` Antonio Gómez',
            'instructor_role' => 'Experto en Simbolismo',
            'instructor_image' => 'https://i.pravatar.cc/40?u=syn1',
            'duration' => 15,
            'status' => 'active',
            'type' => 'synchronous',
            'link' => '#',
        ]);

        // Crear sesiones síncronas
        $sessions = [
            [
                'course_id' => $synchronousCourse->id,
                'title' => 'La Escuadra y el Compás: Símbolos Fundamentales',
                'description' => 'Análisis del simbolismo de la escuadra y el compás en la Masonería.',
                'start_time' => now()->addDays(3)->setTime(19, 0),
                'end_time' => now()->addDays(3)->setTime(21, 0),
                'location' => 'Sala Virtual de la Gran Zona 5',
                'type' => 'synchronous',
                'instructor_name' => $synchronousCourse->instructor_name,
                'instructor_role' => $synchronousCourse->instructor_role,
                'instructor_image' => $synchronousCourse->instructor_image,
                'status' => 'upcoming',
                'link' => '#',
            ],
            [
                'course_id' => $synchronousCourse->id,
                'title' => 'El Signo de Aprendiz: Camino de la Iluminación',
                'description' => 'Exploración del simbolismo del Signo de Aprendiz y su aplicación en la vida diaria.',
                'start_time' => now()->addDays(10)->setTime(19, 0),
                'end_time' => now()->addDays(10)->setTime(21, 0),
                'location' => 'Sala Virtual de la Gran Zona 5',
                'type' => 'synchronous',
                'instructor_name' => $synchronousCourse->instructor_name,
                'instructor_role' => $synchronousCourse->instructor_role,
                'instructor_image' => $synchronousCourse->instructor_image,
                'status' => 'upcoming',
                'link' => '#',
            ],
            [
                'course_id' => $synchronousCourse->id,
                'title' => 'La Piedra Bruta y la Piedra Pulida',
                'description' => 'Simbolismo de la automejora y el perfeccionamiento moral.',
                'start_time' => now()->subDays(2)->setTime(19, 0), // Pasada
                'end_time' => now()->subDays(2)->setTime(21, 0),
                'location' => 'Sala Virtual de la Gran Zona 5',
                'type' => 'synchronous',
                'instructor_name' => $synchronousCourse->instructor_name,
                'instructor_role' => $synchronousCourse->instructor_role,
                'instructor_image' => $synchronousCourse->instructor_image,
                'status' => 'closed',
                'link' => '#',
            ],
        ];

        foreach ($sessions as $session) {
            CourseSession::create($session);
        }
    }
}
