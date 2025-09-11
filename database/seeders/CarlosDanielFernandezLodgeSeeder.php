<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CarlosDanielFernandezLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();

        $lodge = Lodge::where('name', 'Carlos Daniel Fernández')->first();

        if ($lodge) {
            $membersData = [
                ['name' => 'José Fernández', 'national_id' => '12643954', 'phone' => '0424-9476551', 'position' => 'Venerable Maestro'],
                ['name' => 'Juvenal Marcano', 'national_id' => '11510717', 'phone' => '0426-5941018', 'position' => 'Primer Vigilante'],
                ['name' => 'Miguel Betancourt', 'national_id' => '8928919', 'phone' => '0424-9047097', 'position' => 'Segundo Vigilante'],
                ['name' => 'Kelvin Medrano', 'national_id' => '11513513', 'phone' => '0424-9083190', 'position' => 'Orador Fiscal'],
                ['name' => 'Oscar Velásquez', 'national_id' => '9948207', 'phone' => '04269221320', 'position' => 'Secretario Guarda Sello y Timbre'],
                ['name' => 'Castor Rivas', 'national_id' => '3307614', 'phone' => '0286 9360409', 'position' => 'Tesorero'],
                ['name' => 'Nelson Moya', 'national_id' => '8526517', 'phone' => '0426-2207621', 'position' => 'Hospitalario'],
                ['name' => 'Ronal Bello', 'national_id' => '16630412', 'phone' => '0424-9454090', 'position' => 'Primer Experto'],
                ['name' => 'Johan Barreto', 'national_id' => '18074033', 'phone' => '0424-9341045', 'position' => 'Segundo Experto'],
                ['name' => 'Jose Arteaga', 'national_id' => '14505030', 'phone' => '04249301687', 'position' => 'Primer Maestro de Ceremonias'],
                ['name' => 'Romer Marcano', 'national_id' => '12546226', 'phone' => '0416-3259842', 'position' => 'Segundo Maestro de Ceremonias'],
                ['name' => 'Noel Villaroel', 'national_id' => '11209414', 'phone' => '04249468050', 'position' => 'Guarda Templo Interior'],
            ];

            $positionsMap = Position::pluck('id', 'name');

            foreach ($membersData as $memberData) {
                $nationalId = !empty($memberData['national_id']) ? str_replace(['.', ','], '', $memberData['national_id']) : null;
                $name = $memberData['name'];

                $user = User::firstOrCreate(
                    $nationalId ? ['national_id' => $nationalId] : ['name' => $name],
                    [
                        'name' => $name,
                        'national_id' => $nationalId,
                        'email' => null,
                        'password' => Hash::make('password'),
                        'phone_number' => $memberData['phone'],
                        'degree' => 'Maestro', // Assuming Maestro as default
                    ]
                );

                $user->roles()->syncWithoutDetaching([$memberRole->id]);

                $positionId = $positionsMap[$memberData['position']] ?? null;

                if ($positionId) {
                    $user->lodges()->syncWithoutDetaching([$lodge->id => ['position_id' => $positionId]]);
                }
            }
        }
    }
}
