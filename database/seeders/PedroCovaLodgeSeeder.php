<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PedroCovaLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();

        $pedroCovaLodge = Lodge::where('name', 'Pedro Cova')->first();

        if ($pedroCovaLodge) {
            $membersData = [
                ['name' => 'Jairo Jaisinho Figueras Rivas', 'phone' => '0426-4901065', 'position' => 'Venerable Maestro'],
                ['name' => 'José Cipriano Díaz', 'phone' => '0424-9636567', 'position' => 'Primer Vigilante'],
                ['name' => 'Deiher Moisés Muñiz Yépez', 'phone' => '0414-8818875', 'position' => 'Segundo Vigilante'],
                ['name' => 'Gerardo Andrés Cova Rivas', 'phone' => '0416-1004979', 'position' => 'Secretario Guarda Sello y Timbre'],
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
                    $user->lodges()->syncWithoutDetaching([$pedroCovaLodge->id => ['position_id' => $positionId]]);
                }
            }
        }
    }
}
