<?php

namespace Database\Seeders;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Database\Seeder;

class RepositorySeeder extends Seeder
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

        $repositories = [
            [
                'title' => 'Fundación de la Gran Logia',
                'description' => 'Un recorrido por los eventos y personajes que dieron origen a nuestra Gran Logia de la República de Venezuela.',
                'category' => 'Historia',
                'grade_level' => 'Todos',
                'file_type' => 'pdf',
                'file_name' => 'fundacion-gran-logia.pdf',
                'file_path' => 'documents/historia/fundacion-gran-logia.pdf',
                'file_size' => 1024000,
                'uploaded_by' => $user->id,
                'uploaded_at' => now()->subDays(30),
            ],
            [
                'title' => 'El Ritual del Compañero',
                'description' => 'Análisis simbólico de los elementos y juramentos del segundo grado masónico.',
                'category' => 'Ritual',
                'grade_level' => 'Compañero',
                'file_type' => 'pdf',
                'file_name' => 'ritual-companero.pdf',
                'file_path' => 'documents/ritual/ritual-companero.pdf',
                'file_size' => 2048000,
                'uploaded_by' => $user->id,
                'uploaded_at' => now()->subDays(15),
            ],
            [
                'title' => 'Constitución de la G.L.R.V.',
                'description' => 'Documento fundamental que rige nuestra orden y establece los principios masónicos.',
                'category' => 'Administración',
                'grade_level' => 'Todos',
                'file_type' => 'pdf',
                'file_name' => 'constitucion-glrv.pdf',
                'file_path' => 'documents/administracion/constitucion-glrv.pdf',
                'file_size' => 512000,
                'uploaded_by' => $user->id,
                'uploaded_at' => now()->subDays(7),
            ],
            [
                'title' => 'La Influencia de la Ilustración',
                'description' => 'Cómo los principios de la Ilustración moldearon la masonería moderna y contemporánea.',
                'category' => 'Historia',
                'grade_level' => 'Maestro',
                'file_type' => 'pdf',
                'file_name' => 'influencia-ilustracion.pdf',
                'file_path' => 'documents/historia/influencia-ilustracion.pdf',
                'file_size' => 1536000,
                'uploaded_by' => $user->id,
                'uploaded_at' => now()->subDays(3),
            ],
            [
                'title' => 'Plancha de Arquitectura Masónica',
                'description' => 'Estudio detallado de los símbolos arquitectónicos en la masonería simbólica.',
                'category' => 'Formación',
                'grade_level' => 'Maestro',
                'file_type' => 'pdf',
                'file_name' => 'plancha-arquitectura.pdf',
                'file_path' => 'documents/formacion/plancha-arquitectura.pdf',
                'file_size' => 768000,
                'uploaded_by' => $user->id,
                'uploaded_at' => now()->subDays(1),
            ],
            [
                'title' => 'Decreto N° 23-05',
                'description' => 'Decreto emitido por la Gran Logia sobre la organización territorial de las zonas.',
                'category' => 'Administración',
                'grade_level' => 'Todos',
                'file_type' => 'pdf',
                'file_name' => 'decreto-23-05.pdf',
                'file_path' => 'documents/administracion/decreto-23-05.pdf',
                'file_size' => 256000,
                'uploaded_by' => $user->id,
                'uploaded_at' => now(),
            ],
        ];

        foreach ($repositories as $repository) {
            Repository::create($repository);
        }
    }
}