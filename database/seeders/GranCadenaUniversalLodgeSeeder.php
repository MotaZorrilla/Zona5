<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GranCadenaUniversalLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();

        $granCadenaUniversalLodge = Lodge::where('name', 'Gran Cadena Universal')->first();

        if ($granCadenaUniversalLodge) {
            $membersData = [
                [
                    'name' => 'Eulices Rafael Cedeño Naranjo',
                    'national_id' => '8521843',
                    'phone' => '0424-9338701',
                    'position' => 'Venerable Maestro',
                ],
                [
                    'name' => 'David Jesús Farrera Rodríguez',
                    'national_id' => '8179402',
                    'phone' => '04148685479',
                    'position' => 'Secretario Guarda Sello y Timbre', // Assuming Secretario is Secretario Guarda Sello y Timbre
                ],
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
                        'email' => $memberData['email'] ?? null,
                        'password' => Hash::make('password'),
                        'phone_number' => $memberData['phone'] ?? null,
                        'degree' => $memberData['degree'] ?? 'Maestro',
                    ]
                );

                $user->roles()->syncWithoutDetaching([$memberRole->id]);

                $positionId = $positionsMap[$memberData['position']] ?? null;

                if ($positionId) {
                    $user->lodges()->syncWithoutDetaching([$granCadenaUniversalLodge->id => ['position_id' => $positionId]]);
                }
            }
        }
    }
}