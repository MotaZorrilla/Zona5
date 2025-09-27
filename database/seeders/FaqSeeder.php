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
                'answer' => 'La Masonería es una institución esencialmente filantrópica, filosófica e iniciática, que tiene como objetivo el perfeccionamiento moral e intelectual del ser humano, así como el fomento de la fraternidad entre todos los hombres.',
                'category' => 'General',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'question' => '¿Cuáles son los principios fundamentales de la Masonería?',
                'answer' => 'Los principios fundamentales de la Masonería son: Libertad, Igualdad y Fraternidad. Estos principios guían todas nuestras acciones y trabajos, promoviendo el respeto mutuo y el desarrollo personal.',
                'category' => 'General',
                'is_active' => true,
                'order' => 2,
            ],
            [
                'question' => '¿Cómo puedo unirme a la Masonería?',
                'answer' => 'Para ingresar en la Masonería es necesario ser presentado por un miembro activo y pasar por un proceso de selección. Los requisitos básicos incluyen ser mayor de edad, tener buena reputación moral y creer en un Ser Superior.',
                'category' => 'Membresía',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'question' => '¿La Masonería es una religión?',
                'answer' => 'No, la Masonería no es una religión. Es una institución que respeta todas las creencias religiosas y requiere que sus miembros crean en un Ser Superior, pero no impone ningún dogma religioso específico.',
                'category' => 'General',
                'is_active' => true,
                'order' => 3,
            ],
            [
                'question' => '¿Cuáles son los grados en la Masonería?',
                'answer' => 'La Masonería simbólica cuenta con tres grados principales: Aprendiz, Compañero y Maestro Masón. Estos grados representan diferentes etapas en el desarrollo personal y el conocimiento masónico.',
                'category' => 'Grados',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'question' => '¿Qué actividades realiza la Gran Zona 5?',
                'answer' => 'La Gran Zona 5 coordina las actividades de las logias en el Estado Bolívar, incluyendo tenidas, eventos culturales, obras de beneficencia, formación masónica y el mantenimiento de las tradiciones de la Orden.',
                'category' => 'Actividades',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'question' => '¿Dónde se reúne la Gran Zona 5?',
                'answer' => 'La Gran Zona 5 tiene su sede principal en el Estado Bolívar y coordina las actividades de múltiples logias en la región. Para información específica sobre reuniones, contacte con nosotros.',
                'category' => 'Contacto',
                'is_active' => true,
                'order' => 1,
            ],
            [
                'question' => '¿La Masonería participa en política?',
                'answer' => 'La Masonería como institución no participa en política partidista. Sin embargo, promueve los valores cívicos y el desarrollo de ciudadanos responsables que pueden contribuir positivamente a la sociedad.',
                'category' => 'General',
                'is_active' => true,
                'order' => 4,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}