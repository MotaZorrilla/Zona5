<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class JuanFranciscoGironLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        $juanFranciscoGironLodge = Lodge::where('name', 'Juan Francisco Girón')->first();
        if ($juanFranciscoGironLodge) {
            $juanFranciscoGironMembersData = [
                ['name' => 'SIFONTES, JOSE RAMON', 'national_id' => '9908034', 'degree' => 'Maestro', 'position' => 'Venerable Maestro', 'email' => null],
                ['name' => 'MORENO MALAVE, ALEJANDRO ANTONIO', 'national_id' => '10554969', 'degree' => 'Maestro', 'position' => 'Primer Vigilante', 'email' => null],
                ['name' => 'SALAZAR FAJARDO, MANUEL JOSE', 'national_id' => '25277420', 'degree' => 'Maestro', 'position' => 'Segundo Vigilante', 'email' => null],
                ['name' => 'RIVAS ESTABA, DAVID ALEJANDRO', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Secretario Guarda Sello y Timbre', 'email' => null],
                ['name' => 'Carlos E. Meta G.', 'national_id' => null, 'degree' => 'Maestro', 'position' => 'Miembro', 'email' => 'bioacmeta@gmail.com'], // Assuming Maestro as default for sender
            ];

            // Map positions to their IDs
            $positionsMap = [];
            $allPositions = Position::all();
            foreach ($allPositions as $pos) {
                $positionsMap[$pos->name] = $pos->id;
            }

            foreach ($juanFranciscoGironMembersData as $memberData) {
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
                        'phone_number' => $memberData['phone'] ?? null,
                        'degree' => $degree,
                        'initiation_date' => isset($memberData['initiation_date']) ? \Carbon\Carbon::createFromFormat('d/m/Y', $memberData['initiation_date'])->format('Y-m-d') : null,
                        // Other fields can be null
                        'birth_date' => null,
                        'profession' => null,
                    ]
                );

                $positionId = $positionsMap[$memberData['position']] ?? null;

                if ($positionId) {
                    $user->lodges()->syncWithoutDetaching([$juanFranciscoGironLodge->id => ['position_id' => $positionId]]);
                } else {
                    // If position not found, assign general member position
                    $user->lodges()->syncWithoutDetaching([$juanFranciscoGironLodge->id => ['position_id' => $memberPosition->id]]);
                }
                $user->roles()->syncWithoutDetaching([$memberRole->id]); // Assign general member role
            }
        }
    }
}
