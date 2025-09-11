<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EstrellaGuzmanBlancoLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();
        $vmPosition = Position::where('name', 'Venerable Maestro')->first();

        $estrellaGuzmanBlancoLodge = Lodge::where('name', 'Estrella Guzmán Blanco')->first();

        if ($estrellaGuzmanBlancoLodge) {
            $membersData = [
                ['name' => 'Aníbal José Acevedo', 'national_id' => '5707256', 'degree' => 'Maestro'],
                ['name' => 'Hernando Gallego Rios', 'national_id' => '24029536', 'degree' => 'Maestro'],
                ['name' => 'Amado José Manzano', 'national_id' => '4258270', 'degree' => 'Maestro'],
                ['name' => 'Félix Ramón Pinto Odreman', 'national_id' => '11512497', 'degree' => 'Maestro', 'position_id' => $vmPosition->id],
                ['name' => 'Jesús Mitridates Mendoza Yanez', 'national_id' => '8884487', 'degree' => 'Maestro'],
                ['name' => 'Juan Agustin Monagas Diaz', 'national_id' => '4963657', 'degree' => 'Maestro'],
                ['name' => 'José Elias Anas Bonalde', 'national_id' => '9098326', 'degree' => 'Maestro'],
                ['name' => 'Elis Regino Pachano Lejarazo', 'national_id' => '15002337', 'degree' => 'Compañero'],
                ['name' => 'Alfonso Enrique Altamiranda Jiménez', 'national_id' => '9216306', 'degree' => 'Compañero'],
                ['name' => 'Tirso Rafael Barcelo Campos', 'national_id' => '4335044', 'degree' => 'Maestro'],
                ['name' => 'Leonardo Ramírez', 'national_id' => '10171976', 'degree' => 'Maestro'],
                ['name' => 'José Luis Rodriguez Moreira', 'national_id' => '15001138', 'degree' => 'Maestro'],
                ['name' => 'Gustavo Adolfo Henriquez Boscan', 'national_id' => '16164811', 'degree' => 'Maestro'],
                ['name' => 'Jairo Rafael Páez Pantoja', 'national_id' => '14289377', 'degree' => 'Maestro'],
                ['name' => 'José Ricardo Bermúdez', 'national_id' => '14043680', 'degree' => 'Maestro'],
                ['name' => 'José Ventura Rivas', 'national_id' => '1621495', 'degree' => 'Maestro'],
                ['name' => 'Hugo Domingo Arias', 'national_id' => '953717', 'degree' => 'Maestro'],
            ];

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
                        'degree' => $memberData['degree'],
                    ]
                );

                $user->roles()->syncWithoutDetaching([$memberRole->id]);
                $positionId = $memberData['position_id'] ?? $memberPosition->id;
                $user->lodges()->syncWithoutDetaching([$estrellaGuzmanBlancoLodge->id => ['position_id' => $positionId]]);
            }
        }
    }
}
