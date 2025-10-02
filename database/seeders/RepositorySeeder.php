<?php

namespace Database\Seeders;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepositorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpia la tabla para un estado inicial limpio
        DB::table('repositories')->delete();

        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin Fundador',
                'email' => 'admin@example.com',
            ]);
        }

        $repositories = [
            [
                'title' => 'Reglamento de Publicaciones y Medios Digitales',
                'description' => 'Reglamento oficial que norma el uso de páginas web, correos electrónicos y otras publicaciones electrónicas de la Gran Logia de la República de Venezuela. Actualización 2020.',
                'category' => 'Reglamentos',
                'grade_level' => 'Todos',
                'file_type' => 'pdf',
                'file_name' => 'REGLAMENTO DE PUBLICACIONES EN MEDIOS IMPRESOS Y GESTIÓN EN PLATAFORMAS DIGITALES (1).pdf',
                'file_path' => 'repository/REGLAMENTO DE PUBLICACIONES EN MEDIOS IMPRESOS Y GESTIÓN EN PLATAFORMAS DIGITALES (1).pdf',
                'file_size' => 878809,
                'uploaded_by' => $user->id,
                'uploaded_at' => now(),
            ],
            [
                'title' => 'Newsletter G.L.S. del Paraguay N° 194 (Sept 2025)',
                'description' => 'Boletín informativo de la Gran Logia Simbólica del Paraguay, edición N° 194 de septiembre de 2025. Contiene información sobre el Séptimo Encuentro Masónico Binacional Fraternidad y Esperanza.',
                'category' => 'Boletines',
                'grade_level' => 'Todos',
                'file_type' => 'pdf',
                'file_name' => 'GLSP-Newsletter194.pdf',
                'file_size' => 3020529,
                'uploaded_by' => $user->id,
                'uploaded_at' => now(),
            ],
            [
                'title' => 'Modelo de Reporte Automático del Portal',
                'description' => 'Primer modelo del reporte automático generado por el sistema del Portal de la Zona 5. Publicado para consulta, análisis y para generar un debate constructivo sobre la información presentada.',
                'category' => 'Informes',
                'grade_level' => 'Todos',
                'file_type' => 'pdf',
                'file_name' => 'Modelo de Reporte Automatico.pdf',
                'file_path' => 'repository/Modelo de Reporte Automatico.pdf',
                'file_size' => 219681,
                'uploaded_by' => $user->id,
                'uploaded_at' => now(),
            ],
        ];

        foreach ($repositories as $repositoryData) {
            Repository::create($repositoryData);
        }
    }
}
