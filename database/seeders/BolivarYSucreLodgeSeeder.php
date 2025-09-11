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

class BolivarYSucreLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();

        $bolivarYSucreLodge = Lodge::where('name', 'Bolivar y Sucre')->first();

        if ($bolivarYSucreLodge) {
            // Removed update for phone_vm, phone_sec, instagram as per user instruction

            $membersData = [
                // Data from the second list with positions
                ['name' => 'DAVID JOSÉ RODRÍGUEZ', 'national_id' => '9945651', 'phone' => '04249550603', 'email' => 'sirroda3@gmail.com', 'position' => 'Venerable Maestro'],
                ['name' => 'OSCAR DE JESÚS RODRÍGUEZ ARCINIEGAS', 'national_id' => '13920861', 'phone' => '04267920729', 'email' => 'rodriguezarciniegas69@gmail.com', 'position' => 'Ex Venerable Maestro'],
                ['name' => 'FÉLIX MANUEL APONTE DÁVILA', 'national_id' => '5136364', 'phone' => '04148776413', 'email' => 'chinoaponte@hotmail.com', 'position' => 'Primer Vigilante'],
                ['name' => 'CARLOS RAFAEL META RODRÍGUEZ', 'national_id' => '17069592', 'phone' => '04147603356', 'email' => 'trinidad35@gmail.com', 'position' => 'Segundo Vigilante'],
                ['name' => 'CÉSAR GUSTAVO FIGUERA CARPIO', 'national_id' => '4504406', 'phone' => '04249232032', 'email' => 'cchcca@hotmail.com', 'position' => 'Orador Fiscal'],
                ['name' => 'LUIS GABRIEL HERNANDEZ MORENO', 'national_id' => '12539488', 'phone' => '04249604961', 'email' => 'gabriel66g@gmail.com', 'position' => 'Secretario Guarda Sello y Timbre'],
                ['name' => 'JUAN LUIS CONO GARCÍA', 'national_id' => '8180201', 'phone' => '0414-8708601', 'email' => 'juanlcono@hotmail.com', 'position' => 'Primer Experto'],
                ['name' => 'DANIEL STEVEN SUNIAGA', 'national_id' => '21196676', 'phone' => '04164928047', 'email' => 'danielsamanto@gmail.com', 'position' => 'Segundo Experto'],
                ['name' => 'PEDRO JOSÉ META VELASQUEZ', 'national_id' => '23505427', 'phone' => '04249317484', 'email' => 'pedrometa1994@gmail.com', 'position' => 'Primer Maestro de Ceremonias'],
                ['name' => 'MIGUEL ÁNGEL GÓMEZ HERNÁNDEZ', 'national_id' => '10930789', 'phone' => '04148896602', 'email' => 'comtecnologiamiguel@hotmail.com', 'position' => 'Segundo Maestro de Ceremonias'],
                ['name' => 'JOSÉ GREGORIO TERÁN RAMÍREZ', 'national_id' => '7943201', 'phone' => '04140221215', 'email' => 'joseteranr30@gmail.com', 'position' => 'Tesorero'],
                ['name' => 'JARDIEL GARCIA SALIDO', 'national_id' => '31933283', 'phone' => '04123160076', 'email' => 'jardiel71@hotmail.com', 'position' => 'Hospitalario'],
                ['name' => 'LUIS LEONARDO TRIANA TORRES', 'national_id' => '84609857', 'phone' => '04249607278', 'email' => 'ronishadia78@gmail.com', 'position' => 'Primer Diácono'],
                ['name' => 'RACHID YASBEK VALDEZ', 'national_id' => '10389109', 'phone' => '04148985435', 'email' => 'rachidyasbekv@gmail.com', 'position' => 'Segundo Diácono'],
                ['name' => 'JESÚS RAFAEL META GONZÁLEZ', 'national_id' => '3900894', 'phone' => '04148982784', 'email' => 'odrafaelmeta@gmail.com', 'position' => 'Guarda Templo Interior'],

                // Data from the first list (with corrected degrees)
                ['name' => 'NAIM KHALED HALIM', 'national_id' => '82264464', 'degree' => 'Compañero', 'phone' => '0424-9420046', 'email' => 'khaled_naim.5@hotmail.com', 'profession' => 'COMERCIANTE', 'position' => 'Miembro'],
                ['name' => 'HERRADEZ FLORES VICTOR MANUEL', 'national_id' => '12893518', 'degree' => 'Compañero', 'phone' => '0414-8647327', 'email' => 'victorherradez@gmail.com', 'profession' => 'T.S.U. ADM. INDUSTRIAL', 'position' => 'Miembro'],
                ['name' => 'JIMENEZ HERNANDEZ CRISTIAN JOSE', 'national_id' => '12643356', 'degree' => 'Aprendiz', 'phone' => '0414-8715576', 'email' => 'cristianj1974@gmail.com', 'profession' => 'CHOFER', 'position' => 'Miembro'],
                ['name' => 'PADRON GUAIQUIRE LUIS ALEJANDRO', 'national_id' => '25086083', 'degree' => 'Aprendiz', 'phone' => '0424-6044299', 'email' => 'luispadronguaiquire24@gmail.com', 'profession' => 'FUNCIONARIO ACTIVO DEL CICPC', 'position' => 'Miembro'],
                ['name' => 'RAMIREZ AGUILERA OSCAR ENRIQUE', 'national_id' => '25559689', 'degree' => 'Aprendiz', 'phone' => '0412-1850579', 'email' => 'osramdj@gmail.com', 'profession' => 'LOCUTOR COMERCIAL, PNI', 'position' => 'Miembro'],
            ];

            $positionsMap = Position::pluck('id', 'name');

            foreach ($membersData as $memberData) {
                $user = User::firstOrCreate(
                    ['national_id' => $memberData['national_id']],
                    [
                        'name' => $memberData['name'],
                        'email' => $memberData['email'],
                        'password' => Hash::make('password'),
                        'phone_number' => $memberData['phone'],
                        'profession' => $memberData['profession'] ?? null,
                    ]
                );

                $user->roles()->syncWithoutDetaching([$memberRole->id]);

                $positionId = $positionsMap[$memberData['position']] ?? null;

                if ($positionId) {
                    $user->lodges()->syncWithoutDetaching([$bolivarYSucreLodge->id => ['position_id' => $positionId]]);
                }
            }
        }
    }
}