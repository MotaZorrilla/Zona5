<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DrCesarObdulioIriarteLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        $lodge = Lodge::where('name', 'Dr Cesar Obdulio Iriarte')->first();

        if ($lodge) {
            $membersData = [
                ['name' => 'JESUS ANDRES APONTE LOPEZ', 'national_id' => '17420119', 'birth_date' => '1986-03-21', 'initiation_date' => '2021-12-05', 'degree' => 'Maestro', 'phone' => '0412-1819669', 'email' => 'ANDRESAPONTE21@GMAIL.COM', 'profession' => 'ABOGADO'],
                ['name' => 'ANTONIO JOSE GREGORIO CAMPOS SILVEIRA', 'national_id' => '22588797', 'birth_date' => '1994-11-06', 'initiation_date' => '2016-08-11', 'degree' => 'Maestro', 'phone' => '0412-8627951', 'email' => 'ANTOJGCS@GMAIL.COM', 'profession' => 'INGENIERO CIVIL'],
                ['name' => 'GUSTAVO ADOLFO GALINDO SILVA', 'national_id' => '12643460', 'birth_date' => '1975-09-01', 'initiation_date' => '2016-08-13', 'degree' => 'Maestro', 'phone' => '0414-8655893', 'email' => 'GUSADOGASI@GMAIL.COM', 'profession' => 'TSU EN ADMINISTRADOR'],
                ['name' => 'LUIBER JOSE GÓMEZ CORDOBA', 'national_id' => '25693401', 'birth_date' => '1996-11-18', 'initiation_date' => '2018-11-22', 'degree' => 'Maestro', 'phone' => '0414-8589227', 'email' => 'LIUBER18@GMAI.COM', 'profession' => 'ESTUDIANTE'],
                ['name' => 'RAFAEL HERNANDEZ GURMEITE', 'national_id' => '9412883', 'birth_date' => '1968-07-14', 'initiation_date' => '2005-11-26', 'degree' => 'Maestro', 'phone' => '0424-9736919', 'email' => 'GOURMEITTE@GMAIL.COM', 'profession' => 'TSU INFORMATICA'],
                ['name' => 'JOSÉ LUIS LOZADA MARQUEZ', 'national_id' => '5231213', 'birth_date' => '1955-07-20', 'initiation_date' => '1999-07-23', 'degree' => 'Maestro', 'phone' => '0414-8969383', 'email' => 'JOSELLOZADAM@GMAIL.COM', 'profession' => 'COMERCIANTE'],
                ['name' => 'JOSE MANUEL NAVAS BERMUDEZ', 'national_id' => '11532018', 'birth_date' => '1972-05-21', 'initiation_date' => '2016-08-11', 'degree' => 'Maestro', 'phone' => '0412-9450326', 'email' => 'JNAVASB@GMAIL.COM', 'profession' => 'COMERCIANTE'],
                ['name' => 'ANDRICK ALBERDHY PULIDO PINTO', 'national_id' => '10930132', 'birth_date' => '1971-02-05', 'initiation_date' => null, 'degree' => 'Maestro', 'phone' => '0424-9339418', 'email' => 'ALBERDHY@GMAIL.COM', 'profession' => 'COMERCIANTE'],
                ['name' => 'PEDRO ELIAS MUÑOZ LANZ', 'national_id' => '4595630', 'birth_date' => '1952-03-08', 'initiation_date' => '1995-11-28', 'degree' => 'Maestro', 'phone' => '04249649774', 'email' => 'pedromlanz@gmail.com', 'profession' => 'ING. EN ELECTRONICA Y ELECTRICIDAD'],
                ['name' => 'RENNY GALINDO LOPEZ', 'national_id' => '10338022', 'birth_date' => '1972-10-20', 'initiation_date' => '2024-04-20', 'degree' => 'Aprendiz', 'phone' => '04148708177', 'email' => 'rennyg@gmail.com', 'profession' => 'COMERCIANTE'],
                ['name' => 'ARMANDO RAFAEL MELGAR LINARES', 'national_id' => '11534216', 'birth_date' => '1971-04-26', 'initiation_date' => '2024-04-20', 'degree' => 'Aprendiz', 'phone' => '04124472612', 'email' => 'armando.upata71@gmail.com', 'profession' => 'BACHILLER'],
                ['name' => 'FELIX ALEJANDRO ZAMBRANO', 'national_id' => '13089357', 'birth_date' => '1975-11-23', 'initiation_date' => '1907-12-06', 'degree' => 'Aprendiz', 'phone' => '04249640815', 'email' => 'felixalejandrozambrano@gmail.com', 'profession' => 'bachiller'],
                ['name' => 'MANUEL CARLOS VALDEZ RODRIGUEZ', 'national_id' => '16628073', 'birth_date' => '1983-03-05', 'initiation_date' => '2006-09-09', 'degree' => 'Maestro', 'phone' => '0414-8942464', 'email' => 'MANUELVALDEZ83@GMAIL.COM', 'profession' => 'ABOGADO'],
                ['name' => 'MIGUEL ALEJANDRO VALDEZ RODRIGUEZ', 'national_id' => '12131879', 'birth_date' => '1974-08-30', 'initiation_date' => '2012-08-08', 'degree' => 'Maestro', 'phone' => '0414-8675913', 'email' => 'MIGUEANDE25@GMAIL.COM', 'profession' => 'TSU EN ELECTRICIDAD'],
            ];

            $positionsData = [
                ['name' => 'GUSTAVO ADOLFO GALINDO SILVA', 'position' => 'Venerable Maestro'],
                ['name' => 'MIGUEL ALEJANDRO VALDEZ RODRIGUEZ', 'position' => 'Primer Vigilante'],
                ['name' => 'JOSE MANUEL NAVAS BERMUDEZ', 'position' => 'Segundo Vigilante'],
                ['name' => 'MANUEL CARLOS VALDEZ RODRIGUEZ', 'position' => 'Orador Fiscal'],
                ['name' => 'PEDRO ELIAS MUÑOZ LANZ', 'position' => 'Secretario Guarda Sello y Timbre'],
            ];

            $positionsMap = Position::pluck('id', 'name');

            foreach ($membersData as $memberData) {
                $user = User::firstOrCreate(
                    ['national_id' => $memberData['national_id']],
                    [
                        'name' => $memberData['name'],
                        'email' => $memberData['email'],
                        'password' => Hash::make('password'),
                        'birth_date' => Carbon::parse($memberData['birth_date']),
                        'initiation_date' => Carbon::parse($memberData['initiation_date']),
                        'degree' => $memberData['degree'],
                        'phone_number' => $memberData['phone'],
                        'profession' => $memberData['profession'],
                    ]
                );

                $user->roles()->syncWithoutDetaching([$memberRole->id]);

                $positionName = 'Miembro';
                foreach($positionsData as $position) {
                    if ($position['name'] === $user->name) {
                        $positionName = $position['position'];
                        break;
                    }
                }

                $positionId = $positionsMap[$positionName] ?? $memberPosition->id;
                $user->lodges()->syncWithoutDetaching([$lodge->id => ['position_id' => $positionId]]);
            }
        }
    }
}
