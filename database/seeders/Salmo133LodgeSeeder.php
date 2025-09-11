<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Salmo133LodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        $salmo133Lodge = Lodge::where('name', 'Salmo 133')->first();
        if ($salmo133Lodge) {
            $salmo133MembersData = [
                ['name' => 'Diaz, Nestor Ramon', 'national_id' => '14194525', 'degree' => 'Maestro', 'position' => 'Primer Maestro de Ceremonias', 'phone' => '04149205530', 'email' => null],
                ['name' => 'Nabih Jaber, Fidas', 'national_id' => '20505271', 'degree' => 'Maestro', 'position' => 'Primer Experto', 'phone' => '04148957746', 'email' => null],
                ['name' => 'Gil Orzatti, Miguel Angel', 'national_id' => '3942056', 'degree' => 'Maestro', 'position' => 'Venerable Maestro', 'phone' => '04166860099', 'email' => null, 'observations' => 'TES: PRO-TEMPORE'],
                ['name' => 'Pinto Cabello, Wilfredo Antonio', 'national_id' => '5393070', 'degree' => 'Maestro', 'position' => 'Secretario Guarda Sello y Timbre', 'phone' => '04148686339', 'email' => null, 'observations' => 'REPOSO MEDICO'],
                ['name' => 'Ortega, Bismarck', 'national_id' => '8892367', 'degree' => 'Maestro', 'position' => 'Primer Vigilante', 'phone' => '04148706749', 'email' => null],
                ['name' => 'Dacduk Flores, Tony Jose', 'national_id' => '4696820', 'degree' => 'Maestro', 'position' => 'Segundo Vigilante', 'phone' => '04148716779', 'email' => null],
                ['name' => 'Gomez, Oscar', 'national_id' => '10926215', 'degree' => 'Compañero', 'position' => 'Guarda Templo Interior', 'phone' => '04121918374', 'email' => null],
                ['name' => 'Carico, Alexis', 'national_id' => '13016754', 'degree' => 'Maestro', 'position' => 'Orador Fiscal', 'phone' => '04249707262', 'email' => null, 'observations' => 'SEC: PRO-TEMPORE'],
                ['name' => 'Christian Brizuela', 'national_id' => '23730312', 'degree' => 'Aprendiz', 'position' => 'Miembro', 'phone' => '04263219838', 'email' => null, 'initiation_date' => '11/09/2024'],
                ['name' => 'Mario Antonio Valbuena Rodriguez', 'national_id' => '8944793', 'degree' => 'Aprendiz', 'position' => 'Miembro', 'phone' => '04148523185', 'email' => null, 'initiation_date' => '11/09/2024'],
            ];

            // Map positions to their IDs
            $positionsMap = [];
            $allPositions = Position::all();
            foreach ($allPositions as $pos) {
                $positionsMap[$pos->name] = $pos->id;
            }

            foreach ($salmo133MembersData as $memberData) {
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
                        'initiation_date' => isset($memberData['initiation_date']) ? \Carbon\Carbon::createFromFormat('d/m/Y', $memberData['initiation_date'])->format('Y-m-d') : null,
                        // Other fields can be null
                        'birth_date' => null,
                        'profession' => null,
                    ]
                );

                $positionId = $positionsMap[$memberData['position']] ?? null;

                if ($positionId) {
                    $user->lodges()->syncWithoutDetaching([$salmo133Lodge->id => ['position_id' => $positionId]]);
                } else {
                    // If position not found, assign general member position
                    $user->lodges()->syncWithoutDetaching([$salmo133Lodge->id => ['position_id' => $memberPosition->id]]);
                }
                $user->roles()->syncWithoutDetaching([$memberRole->id]); // Assign general member role
            }
        }
    }
}
