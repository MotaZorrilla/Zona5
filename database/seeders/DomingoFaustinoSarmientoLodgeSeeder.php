<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DomingoFaustinoSarmientoLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $lodge = Lodge::where('name', 'Domingo Faustino Sarmiento')->first();

        if ($lodge && $memberRole) {
            $membersData = [
                ['name' => 'Simón Roberto Boada Cabello', 'degree' => 'Maestro', 'position' => 'Secretario Guarda Sello y Timbre', 'phone' => '414-9985973'],
                ['name' => 'José Alfredo Boada Hernandez', 'degree' => 'Maestro', 'position' => 'Venerable Maestro', 'phone' => '424-9505718'],
                ['name' => 'José Emiliano Boada Hernandez', 'degree' => 'Compañero', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'José Emiliano Boada Herrera', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Esteban Brown Israel', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Hipócrates Israel Castrillo Gil', 'degree' => 'Compañero', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Nally Narciso Chekian Echenique', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Celicio Jesús Diamon Corona', 'degree' => 'Maestro', 'position' => 'Maestro Banquete', 'phone' => null],
                ['name' => 'Luis Daniel Duran Subero', 'degree' => 'Maestro', 'position' => 'Primer Diácono', 'phone' => null],
                ['name' => 'Enrique Roberto Expósito Granes', 'degree' => 'Maestro', 'position' => 'Secretario Guarda Sello y Timbre Adjunto', 'phone' => '414-8775920'],
                ['name' => 'David Jesús Farrera Rodriguez', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Juan Carlos Hurtado Soveaux', 'degree' => 'Maestro', 'position' => 'Orador Fiscal', 'phone' => null],
                ['name' => 'Héctor Ramón Mota Zorrilla', 'degree' => 'Maestro', 'position' => 'Primer Experto', 'phone' => null],
                ['name' => 'Gregori Ortega Silva', 'degree' => 'Maestro', 'position' => 'Segundo Vigilante', 'phone' => '416-4262941'],
                ['name' => 'Freddy Ramirez Cuadra', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'José Luis Rey Ferreira', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Aristóbulo Paul Rey Monsalve', 'degree' => 'Maestro', 'position' => 'Orador Fiscal Adjunto', 'phone' => null],
                ['name' => 'Juan Pablo Rondón', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Luis Gerardo Ruiz Rangel', 'degree' => 'Maestro', 'position' => 'Ex Venerable Maestro', 'phone' => null],
                ['name' => 'Enrique Ruiz Lanz Senior', 'degree' => 'Maestro', 'position' => 'Hospitalario', 'phone' => null],
                ['name' => 'Ángel Leoner Patiño Pinto', 'degree' => 'Maestro', 'position' => 'Segundo Maestro de Ceremonias', 'phone' => null],
                ['name' => 'Sergio Francisco Morales Salazar', 'degree' => 'Compañero', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'José Andres Escalona Viña', 'degree' => 'Maestro', 'position' => 'Primer Maestro de Ceremonias', 'phone' => null],
                ['name' => 'Luis Gerardo Ruiz Soto', 'degree' => 'Compañero', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Miguel Enrique Herrera Sequera', 'degree' => 'Compañero', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Carlos Eduardo Medina', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Alexis Antonio Garcia Salazar', 'degree' => 'Compañero', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Douglas Rafael Araya Parra', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Jorge Luis Quintero', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Osmel Ismael Orta', 'degree' => 'Maestro', 'position' => 'Segundo Diácono', 'phone' => null],
                ['name' => 'Ernesto José Villaroel Linch', 'degree' => 'Maestro', 'position' => 'Tesorero', 'phone' => null],
                ['name' => 'Leonardo Alexander Cambridge Daniels', 'degree' => 'Maestro', 'position' => 'Segundo Experto', 'phone' => null],
                ['name' => 'Carlos Alberto Rondón Malave', 'degree' => 'Maestro', 'position' => 'Primer Vigilante', 'phone' => '414-7647640'],
                ['name' => 'José Arcenio Aguilar Saturno', 'degree' => 'Aprendiz', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Victor Riffi Rubio', 'degree' => 'Maestro', 'position' => 'Guarda Templo Interior', 'phone' => null],
                ['name' => 'Andres Rodriguez', 'degree' => 'Aprendiz', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Julio Cesar Febres Cordero', 'degree' => 'Aprendiz', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'José Gregorio Uzcátegui Orozco', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Luis Siso', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Carlos Figueroa', 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Petter Peña', 'degree' => 'Aprendiz', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Marcelo Hernandez', 'degree' => 'Aprendiz', 'position' => 'Miembro', 'phone' => null],
                ['name' => 'Carlos Eduardo Basantes', 'degree' => 'Aprendiz', 'position' => 'Miembro', 'phone' => null],
            ];

            $positionsMap = Position::pluck('id', 'name')->toArray();
            $memberPositionId = $positionsMap['Miembro'] ?? null;

            foreach ($membersData as $memberData) {
                $user = User::firstOrCreate(
                    ['name' => $memberData['name']],
                    [
                        'email' => null,
                        'password' => Hash::make('password'),
                        'phone_number' => $memberData['phone'],
                        'degree' => $memberData['degree'],
                    ]
                );

                $user->roles()->syncWithoutDetaching([$memberRole->id]);

                $positionId = $positionsMap[$memberData['position']] ?? $memberPositionId;

                if ($positionId) {
                    $user->lodges()->syncWithoutDetaching([$lodge->id => ['position_id' => $positionId]]);
                }
            }
        }
    }
}
