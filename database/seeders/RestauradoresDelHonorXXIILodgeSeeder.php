<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RestauradoresDelHonorXXIILodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();

        $lodge = Lodge::where('name', 'Restauradores del Honor XXII')->first();

        if ($lodge) {
            $membersData = [
                [
                    'name' => 'Antonio José Zambrano Rojas',
                    'phone' => '0414-8921811',
                    'position' => 'Venerable Maestro',
                ],
                [
                    'name' => 'Yorbin Alexander Alvarado',
                    'phone' => '0424-9687520',
                    'position' => 'Secretario Guarda Sello y Timbre',
                ],
                [
                    'name' => 'Alexis Jesus Bertho Sanchez',
                    'phone' => '0412-9892954',
                    'position' => 'Primer Vigilante',
                ],
                [
                    'name' => 'Jose Eustolio Cupare Sánchez',
                    'phone' => '0412-2916595',
                    'position' => 'Segundo Vigilante',
                ],
            ];

            $positionsMap = Position::pluck('id', 'name');

            foreach ($membersData as $memberData) {
                $user = User::firstOrCreate(
                    ['name' => $memberData['name']],
                    [
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
