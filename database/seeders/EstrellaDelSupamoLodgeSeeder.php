<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EstrellaDelSupamoLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        $lodge = Lodge::where('name', 'Estrella del Supamo')->first();

        if ($lodge) {
            $membersData = [
                ['name' => 'Edgar Ramón Suárez', 'phone' => '0424-9652455', 'position' => 'Venerable Maestro', 'degree' => 'Maestro'],
                ['name' => 'Asisclo Alberto Parra Uzcátegui', 'phone' => '04242978090', 'position' => 'Primer Vigilante', 'degree' => 'Maestro'],
                ['name' => 'Jhonatan Smith Rosales Lanz', 'phone' => '0424-9504004', 'position' => 'Segundo Vigilante', 'degree' => 'Maestro'],
                ['name' => 'Eleazar Arturo Páez Betancourt', 'phone' => '0424-9503365', 'position' => 'Orador Fiscal', 'degree' => 'Maestro'],
                ['name' => 'Edgar del Jesús Liconti González', 'phone' => '0424-9297093', 'position' => 'Secretario Guarda Sello y Timbre', 'degree' => 'Maestro'],
                ['name' => 'Carlos Miguel Betancourt Jiménez', 'phone' => null, 'position' => 'Tesorero', 'degree' => 'Maestro'],
                ['name' => 'Lució Cirio Suarez', 'phone' => null, 'position' => 'Hospitalario', 'degree' => 'Maestro'],
                ['name' => 'Jesús Mauricio Alcina Noguera', 'phone' => null, 'position' => 'Miembro', 'degree' => 'Aprendiz'],
                ['name' => 'Jorge Elieser Vanegas Duarte', 'phone' => null, 'position' => 'Miembro', 'degree' => 'Aprendiz'],
            ];

            $positionsMap = Position::pluck('id', 'name');

            foreach ($membersData as $memberData) {
                $user = User::firstOrCreate(
                    ['name' => $memberData['name']],
                    [
                        'email' => null,
                        'password' => Hash::make('password'),
                        'phone_number' => $memberData['phone'],
                        'degree' => $memberData['degree'],
                    ]
                );

                $user->roles()->syncWithoutDetaching([$memberRole->id]);

                $positionId = $positionsMap[$memberData['position']] ?? $memberPosition->id;
                $user->lodges()->syncWithoutDetaching([$lodge->id => ['position_id' => $positionId]]);
            }
        }
    }
}
