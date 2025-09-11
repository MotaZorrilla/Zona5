<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class JesusValentinoLatanLaRosaLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        $jesusValentinoLodge = Lodge::where('name', 'Jesus Valentino Latan La Rosa')->first();
        if ($jesusValentinoLodge) {
            $jesusValentinoMembersData = [
                ['name' => 'Hector Jose Brazon Escobar', 'position' => 'Venerable Maestro', 'phone' => '04148978310', 'email' => 'hjbrazon@gmail.com', 'degree' => 'Maestro'],
                ['name' => 'Reinaldo Rosas', 'position' => 'Primer Vigilante', 'phone' => '04148586241', 'email' => null, 'degree' => 'Maestro'],
                ['name' => 'Jose Washington', 'position' => 'Segundo Vigilante', 'phone' => '04265943508', 'email' => null, 'degree' => 'Maestro'],
                ['name' => 'Carlos Silva', 'position' => 'Orador Fiscal', 'phone' => '04249149083', 'email' => null, 'degree' => 'Maestro'],
                ['name' => 'Amin Macdonald', 'position' => 'Secretario Guarda Sello y Timbre', 'phone' => '04249074653', 'email' => null, 'degree' => 'Maestro'],
                ['name' => 'Ivan Escobar', 'position' => 'Miembro', 'degree' => 'Maestro', 'email' => null],
                ['name' => 'José Fermin', 'position' => 'Miembro', 'degree' => 'Maestro', 'email' => null],
                ['name' => 'Noel Lira', 'position' => 'Miembro', 'degree' => 'Maestro', 'email' => null],
                ['name' => 'Arnulfo Yepez', 'position' => 'Miembro', 'degree' => 'Compañero', 'email' => null],
                ['name' => 'Alexis Rosas', 'position' => 'Miembro', 'degree' => 'Aprendiz', 'email' => null],
                ['name' => 'Jhorgen Oscar García', 'position' => 'Miembro', 'degree' => 'Aprendiz', 'email' => null],
                ['name' => 'Miguel Díaz', 'position' => 'Miembro', 'degree' => 'Aprendiz', 'email' => null],
                ['name' => 'Paulo Lira', 'position' => 'Miembro', 'degree' => 'Aprendiz', 'email' => null],
            ];

            // Map positions to their IDs
            $positionsMap = [];
            $allPositions = Position::all();
            foreach ($allPositions as $pos) {
                $positionsMap[$pos->name] = $pos->id;
            }

            foreach ($jesusValentinoMembersData as $memberData) {
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
                $nationalId = data_get($memberData, 'national_id') ? str_replace(['.', ','], '', data_get($memberData, 'national_id')) : null;
                $initiationDate = isset($memberData['initiation_date']) ? \Carbon\Carbon::createFromFormat('d/m/Y', $memberData['initiation_date'])->format('Y-m-d') : null;

                $user = User::firstOrCreate(
                    ['name' => $memberData['name']],
                    [
                        'email' => $email,
                        'password' => Hash::make('password'), // Default password
                        'phone_number' => $memberData['phone'] ?? null,
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
                    $user->lodges()->syncWithoutDetaching([$jesusValentinoLodge->id => ['position_id' => $positionId]]);
                } else {
                    // If position not found, assign general member position
                    $user->lodges()->syncWithoutDetaching([$jesusValentinoLodge->id => ['position_id' => $memberPosition->id]]);
                }
                $user->roles()->syncWithoutDetaching([$memberRole->id]); // Assign general member role
            }
        }
    }
}
