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

class LuzYReflexionLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        $lodge = Lodge::where('name', 'Luz y Reflexión')->first();

        if ($lodge) {
            $membersData = [
                ['name' => 'HIRALDO EVARISTO MONROY P.', 'national_id' => '9861489', 'phone' => '0412-2842931', 'email' => 'hiraldom@gmail.com', 'position' => 'Venerable Maestro', 'degree' => 'Maestro'],
                ['name' => 'JAIRO RAMON TORRES YARA', 'national_id' => '12632936', 'phone' => '0414-8751598', 'email' => 'jairo.torresap@gmail.com', 'position' => 'Ex Venerable Maestro', 'degree' => 'Maestro'],
                ['name' => 'EDISON GONZALEZ MAGALLANES', 'national_id' => '15137958', 'phone' => '0414-8568054', 'email' => 'edisongonzalez_7@hotmail.com', 'position' => 'Primer Vigilante', 'degree' => 'Maestro'],
                ['name' => 'JAIRO RAMON TORRES YARA', 'national_id' => '12632936', 'phone' => '0414-8751598', 'email' => 'jairo.torresap@gmail.com', 'position' => 'Segundo Vigilante', 'degree' => 'Maestro'],
                ['name' => 'LEONARDO RAFAEL NAVARRO C.', 'national_id' => '3422541', 'phone' => '0414-8683411', 'email' => 'lnieves1@hotmail.com', 'position' => 'Orador Fiscal', 'degree' => 'Maestro'],
                ['name' => 'UBALDO ARGENIS IDROGO MARTINEZ', 'national_id' => '8524002', 'phone' => '0424-9036469', 'email' => 'ubardelta7@gmail.com', 'position' => 'Secretario Guarda Sello y Timbre', 'degree' => 'Maestro'],
                ['name' => 'JOSE NEPTALI BLANCO', 'national_id' => '8800147', 'phone' => '0414-3011188', 'email' => 'jnblaco65@gmail.com', 'position' => 'Tesorero', 'degree' => 'Maestro'],
                ['name' => 'JUAN CARLOS VELASQUEZ GONZALEZ', 'national_id' => '17209836', 'phone' => '0424-9204232', 'email' => 'juavelasquez1986@gmail.com', 'position' => 'Primer Experto', 'degree' => 'Maestro'],
                ['name' => 'GUSTAVO ALFREDO RENDON B.', 'national_id' => '8537441', 'phone' => '0414-8945130', 'email' => 'gustavorendon86@gmail.com', 'position' => 'Primer Maestro de Ceremonias', 'degree' => 'Maestro'],
                ['name' => 'ALIRIO JOSE TOVAR', 'national_id' => '10927381', 'phone' => '0416-5861318', 'email' => 'aliriotovar67@hotmail.com', 'position' => 'Guarda Templo Interior', 'degree' => 'Maestro'],
                ['name' => 'LUIS ALFREDO IDROGO SIERRA', 'national_id' => '19730746', 'phone' => '0424-9303229', 'email' => 'laidrogo@gmail.com', 'position' => 'Miembro', 'degree' => 'Compañero'],
                ['name' => 'José Ramón Sierra Palacios', 'national_id' => '5335725', 'phone' => '0414-7618336', 'email' => 'siejose@gmail.com', 'position' => 'Miembro Honorario', 'degree' => 'Maestro'],
                ['name' => 'ANTONIO JOSE VELASQUEZ DIAZ', 'national_id' => null, 'phone' => '0424-9651882', 'email' => null, 'position' => 'Miembro Honorario', 'degree' => 'Maestro'],
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
