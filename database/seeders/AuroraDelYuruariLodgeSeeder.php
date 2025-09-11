<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuroraDelYuruariLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();

        $lodge = Lodge::where('name', 'Aurora del Yuruari')->first();

        if ($lodge) {
            $membersData = [
                ['name' => 'RICARDO ALFONSO BRITO ARASME', 'phone' => '04148111791', 'position' => 'Venerable Maestro'],
                ['name' => 'ALEXIS ANTONIO MARTINEZ BASTARDO', 'phone' => '04148729608', 'position' => 'Primer Vigilante'],
                ['name' => 'JOSE MANUEL MARTINEZ RIVERO', 'phone' => '04121906315', 'position' => 'Segundo Vigilante'],
                ['name' => 'FERNANDO JOSE CORRALES MARTINEZ', 'phone' => '04148729608', 'position' => 'Secretario Guarda Sello y Timbre'],
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
