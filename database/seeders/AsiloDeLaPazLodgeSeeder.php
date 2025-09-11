<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AsiloDeLaPazLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        $asiloDeLaPazLodge = Lodge::where('name', 'Asilo de la Paz')->first();
        if ($asiloDeLaPazLodge) {
            $asiloDeLaPazMembersData = [
                ['name' => 'Ramón José Olivares Espin', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Venerable Maestro', 'phone' => '04242920603', 'email' => null],
                ['name' => 'Rafael Alberto Rodíz Lizardi', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Primer Vigilante', 'phone' => '04249564013', 'email' => null],
                ['name' => 'Jesús Rafael Espinoza Carreño', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Segundo Vigilante', 'phone' => '04261816263', 'email' => null],
                ['name' => 'Douglas Nuñez', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Orador Fiscal', 'phone' => '04249052385', 'email' => null],
                ['name' => 'Yonny José Yeguez Perez', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Secretario Guarda Sello y Timbre', 'phone' => '04128429133', 'email' => null],
                ['name' => 'Arnoldo José Ortiz', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Tesorero', 'phone' => '04143859141', 'email' => null],
                ['name' => 'José Gregorio Tovar', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Hospitalario', 'phone' => '04128755641', 'email' => null],
                ['name' => 'Juan José Colmenares', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Guarda Templo Interior', 'phone' => '04249004807', 'email' => null],
                ['name' => 'Alberto pascual Rodiz Goncalve', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Primer Maestro de Ceremonias', 'phone' => '04164850502', 'email' => null],
                ['name' => 'Hussen Jarboue Farhate', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Segundo Experto', 'phone' => '04148590783', 'email' => null],
                ['name' => 'Carlos Ruben Figarella Von Buren', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Primer Experto', 'phone' => '04249019818', 'email' => null],
                ['name' => 'Giusepe Abate Mauro', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => null, 'email' => null],
                ['name' => 'Luis Alberto Eulacio', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Miembro', 'phone' => '04249374032', 'email' => null],
                ['name' => 'Elisam Nasser', 'national_id' => null, 'degree' => 'Compañero', 'position' => 'Miembro', 'phone' => '04148936723', 'email' => null],
                ['name' => 'Jean Angel Pinto', 'national_id' => null, 'degree' => 'Compañero', 'position' => 'Miembro', 'phone' => '04161834029', 'email' => null],
                ['name' => 'Yermain Ponce', 'national_id' => null, 'degree' => 'Compañero', 'position' => 'Miembro', 'phone' => '04142035496', 'email' => null],
                ['name' => 'José Felix Mendoza', 'national_id' => null, 'degree' => 'Compañero', 'position' => 'Miembro', 'phone' => '04140976246', 'email' => null],
                ['name' => 'Freddy José Cordero Santiago', 'national_id' => null, 'degree' => 'Aprendiz', 'position' => 'Miembro', 'phone' => '04246556805', 'email' => null],
            ];

            // Map positions to their IDs
            $positionsMap = [];
            $allPositions = Position::all();
            foreach ($allPositions as $pos) {
                $positionsMap[$pos->name] = $pos->id;
            }

            foreach ($asiloDeLaPazMembersData as $memberData) {
                $degree = $memberData['degree'];
                // Override degree to Maestro if holding a dignity and current degree is lower
                $dignityPositions = [
                    'Venerable Maestro', 'Primer Vigilante', 'Segundo Vigilante', 'Orador Fiscal',
                    'Secretario Guarda Sello y Timbre', 'Tesorero', 'Guarda Templo Interior',
                    'Hospitalario', 'Primer Experto', 'Segundo Experto', 'Primer Diácono',
                    'Segundo Diácono', 'Venerable Maestro Ad Vitam', 'Ex Venerable Maestro',
                    'Secretario Adjunto', 'Orador Fiscal Adjunto', 'Primer Diputado',
                    'Segundo Diputado', 'Diputado Suplente', 'Primer Maestro de Ceremonias',
                    'Segundo Maestro de Ceremonias', 'Maestro Banquete', 'Secretario Guarda Sello y Timbre Adjunto'
                ];

                if (in_array($memberData['position'], $dignityPositions) && ($degree === 'Aprendiz' || $degree === 'Compañero')) {
                    $degree = 'Maestro';
                }

                $email = $memberData['email'] ?? null;
                $nationalId = $memberData['national_id'] ? str_replace(['.', ','], '', $memberData['national_id']) : null;
                $initiationDate = isset($memberData['initiation_date']) ? \Carbon\Carbon::createFromFormat('d/m/Y', $memberData['initiation_date'])->format('Y-m-d') : null;

                $user = User::firstOrCreate(
                    ['name' => $memberData['name']],
                    [
                        'email' => $email,
                        'password' => Hash::make('password'), // Default password
                        'phone_number' => $memberData['phone'],
                        'degree' => $degree,
                        'initiation_date' => $initiationDate,
                        'national_id' => $nationalId,
                        // Other fields can be null
                        'birth_date' => null,
                        'profession' => null,
                    ]
                );

                $positionId = $positionsMap[$memberData['position']] ?? null;

                if ($positionId) {
                    $user->lodges()->syncWithoutDetaching([$asiloDeLaPazLodge->id => ['position_id' => $positionId]]);
                } else {
                    // If position not found, assign general member position
                    $user->lodges()->syncWithoutDetaching([$asiloDeLaPazLodge->id => ['position_id' => $memberPosition->id]]);
                }
                $user->roles()->syncWithoutDetaching([$memberRole->id]); // Assign general member role
            }
        }
    }
}
