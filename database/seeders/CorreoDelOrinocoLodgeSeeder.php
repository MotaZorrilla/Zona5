<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CorreoDelOrinocoLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();

        $lodge = Lodge::where('name', 'Correo del Orinoco')->first();

        if ($lodge) {
            $membersData = [
                ['name' => 'BENJAMIN HORACIO BOLIVAR HERRERA', 'national_id' => '12188021', 'phone' => '0414-8534567', 'email' => 'benjaminbolivarh@hotmail.com', 'position' => 'Venerable Maestro'],
                ['name' => 'DIONKER JOSÉ GONZÁLEZ ROJAS', 'national_id' => '15347050', 'phone' => '0416-6864150', 'email' => 'yonkijose@yahoo.com', 'position' => 'Primer Vigilante'],
                ['name' => 'JORGE LUIS INFANTE ALCANTARA', 'national_id' => '3900967', 'phone' => '0414-3854601', 'email' => 'infantesjorge@hotmail.com', 'position' => 'Segundo Vigilante'],
                ['name' => 'MANUEL SEGUNDO KRONEY MANEIRO', 'national_id' => '8343764', 'phone' => '0416-6856413', 'email' => 'mskroney3@hotmail.com', 'position' => 'Orador Fiscal'],
                ['name' => 'FÉLIX INOCENTE YTRIAGO', 'national_id' => '9277425', 'phone' => '0414-8528529', 'email' => 'retoaldestinopedagogo@gmail.com', 'position' => 'Secretario Guarda Sello y Timbre'],
                ['name' => 'CESAR RICARDO IRIARTE VIVAS', 'national_id' => '15469258', 'phone' => '0412-6951533', 'email' => 'tkd.cesar@gmail.com', 'position' => 'Primer Experto'],
                ['name' => 'MIGUEL ÁNGEL RIOBUENO CURRA', 'national_id' => '8872499', 'phone' => '0414-9914543', 'email' => 'riomiguel2011@hotmail.com', 'position' => 'Primer Maestro de Ceremonias'],
                ['name' => 'LEONEL JESUS RODRÍGUEZ RONDON', 'national_id' => '11728551', 'phone' => '0416-1812547', 'email' => 'leo_guez@hotmail.com', 'position' => 'Tesorero'],
                ['name' => 'CARLOS ALEXANDER VILLAMEDIANA FLORES', 'national_id' => '11361696', 'phone' => '0416-5850018', 'position' => 'Guarda Templo Interior'],
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