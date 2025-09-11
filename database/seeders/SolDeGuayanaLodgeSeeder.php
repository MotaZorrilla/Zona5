<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SolDeGuayanaLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        $lodge = Lodge::where('name', 'Sol de Guayana')->first();

        if ($lodge) {
            $membersData = [
                ['name' => 'Rafael Ángel Riveras Suegart', 'phone' => '0424-8548484', 'degree' => 'Maestro', 'position' => 'Venerable Maestro'],
                ['name' => 'Antonio José Sequera Chourio', 'phone' => '0426-9348342', 'degree' => 'Maestro', 'position' => 'Primer Vigilante'],
                ['name' => 'Fernando Enrique Cepeda Casas', 'phone' => '0414-8531800', 'degree' => 'Maestro', 'position' => 'Segundo Vigilante'],
                ['name' => 'Antonio Sequera Hernando', 'phone' => '0426-5942469', 'degree' => 'Maestro', 'position' => 'Secretario Guarda Sello y Timbre'],
                ['name' => 'Carmelo Salazar Maestracci', 'phone' => '0424-9506124', 'degree' => 'Maestro', 'position' => 'Orador Fiscal'],
                ['name' => 'Oswaldo Ramón Riveros Caraballo', 'phone' => '0426-5901696', 'degree' => 'Compañero', 'position' => 'Miembro'],
                ['name' => 'José Eduardo de la T. García Velasco', 'phone' => '0414-8531987', 'degree' => 'Compañero', 'position' => 'Miembro'],
                ['name' => 'Abrahan José Salazar Pérez', 'phone' => '0412-8391407', 'degree' => 'Aprendiz', 'position' => 'Miembro'],
                ['name' => 'Sergio Gustavo Vilar Fernández', 'phone' => null, 'degree' => 'Aprendiz', 'position' => 'Miembro'],
                ['name' => 'Jean Pierre Bardou Legall', 'phone' => '0412-7979993', 'degree' => 'Aprendiz', 'position' => 'Miembro'],
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
