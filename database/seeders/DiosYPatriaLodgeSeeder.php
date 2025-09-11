<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DiosYPatriaLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        $diosYPatriaLodge = Lodge::where('name', 'Dios y Patria')->first();
        if ($diosYPatriaLodge) {
            $diosYPatriaMembersData = [
                ['name' => 'Jesus Vicente Aponte Cordero', 'position' => 'Venerable Maestro', 'email' => null, 'national_id' => '15687170', 'phone' => '04148643485'],
                ['name' => 'Pablo de la Cruz Zambrano', 'position' => 'Primer Vigilante', 'email' => 'pablo1956cz@gmail.com', 'national_id' => '4937862', 'phone' => '04262147438'],
                ['name' => 'Ewduar Jiménez', 'position' => 'Segundo Vigilante', 'email' => 'jimenezedwards84@gmail.com', 'national_id' => '17766149', 'phone' => '04164090212'],
                ['name' => 'Freddy Zabala', 'position' => 'Orador Fiscal', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Fernando Vallés', 'position' => 'Secretario', 'email' => 'fernandovalles59@gmail.com', 'national_id' => '12601943', 'phone' => '04163951628'],
                ['name' => 'Domenico Pinto', 'position' => 'Tesorero', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Oracio Escalante', 'position' => 'Hospitalario', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Luis Raúl Arteaga', 'position' => 'Primer Maestro de Ceremonias', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Antonio Rivas', 'position' => 'Primer Experto', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Evelio García', 'position' => 'Segundo Maestro de Ceremonias', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Cristóbal Pereira', 'position' => 'Segundo Experto', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Carlos Morales', 'position' => 'Primer Diácono', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Jesús Malave', 'position' => 'Segundo Diácono', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Ramón Figuera', 'position' => 'Guarda Templo Interior', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Antonio Rivas Vilorio', 'position' => 'Venerable Maestro Ad Vitam', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Sandy Guerra', 'position' => 'Ex Venerable Maestro', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Edgar Rivero', 'position' => 'Miembro', 'email' => null, 'national_id' => null, 'phone' => null, 'degree_override' => 'Maestro'], // M:.M:.
                ['name' => 'Jesus Sifontes', 'position' => 'Miembro', 'email' => null, 'national_id' => null, 'phone' => null, 'degree_override' => 'Maestro'], // M:.M:.
                ['name' => 'Tirzo Arteaga', 'position' => 'Miembro', 'email' => null, 'national_id' => null, 'phone' => null, 'degree_override' => 'Compañero'], // Comp:.
                ['name' => 'Miguel Uribe', 'position' => 'Secretario Adjunto', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Luis Alberto Eulacio', 'position' => 'Miembro', 'email' => null, 'national_id' => null, 'phone' => null, 'degree_override' => 'Maestro'], // M:.M:.
                ['name' => 'José Sardelli', 'position' => 'Miembro Honorario', 'email' => null, 'national_id' => null, 'phone' => null],
                ['name' => 'Mario Hernández', 'position' => 'Miembro Honorario', 'email' => null, 'national_id' => null, 'phone' => null],
            ];

            // Map positions to their IDs
            $positionsMap = [];
            $allPositions = Position::all();
            foreach ($allPositions as $pos) {
                $positionsMap[$pos->name] = $pos->id;
            }

            foreach ($diosYPatriaMembersData as $memberData) {
                $degree = 'Maestro'; // Default for dignities
                if (isset($memberData['degree_override'])) {
                    $degree = $memberData['degree_override'];
                } elseif ($memberData['position'] === 'Miembro') {
                    $degree = 'Aprendiz'; // Default for general members if not overridden
                }

                $nationalId = !empty($memberData['national_id']) ? str_replace(['.', ','], '', $memberData['national_id']) : null;
                $name = $memberData['name'];

                $user = User::firstOrCreate(
                    $nationalId ? ['national_id' => $nationalId] : ['name' => $name],
                    [
                        'name' => $name,
                        'national_id' => $nationalId,
                        'email' => $memberData['email'] ?? null,
                        'password' => Hash::make('password'), // Default password
                        'phone_number' => $memberData['phone'],
                        'degree' => $degree,
                        // Other fields can be null
                        'birth_date' => null,
                        'initiation_date' => null,
                        'profession' => null,
                    ]
                );

                $positionId = $positionsMap[$memberData['position']] ?? null;

                if ($positionId) {
                    $user->lodges()->syncWithoutDetaching([$diosYPatriaLodge->id => ['position_id' => $positionId]]);
                } else {
                    // If position not found, assign general member position
                    $user->lodges()->syncWithoutDetaching([$diosYPatriaLodge->id => ['position_id' => $memberPosition->id]]);
                }
                $user->roles()->syncWithoutDetaching([$memberRole->id]); // Assign general member role
            }
        }
    }
}
