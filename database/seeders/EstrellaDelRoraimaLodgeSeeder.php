<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EstrellaDelRoraimaLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();

        $lodge = Lodge::where('name', 'Estrella de Roraima')->first();

        if ($lodge) {
            $membersData = [
                ['name' => 'Reinaldo Ramon Mendires Cova', 'national_id' => '10040398', 'phone' => '04146137', 'email' => 'reymendires@hotmail.com', 'position' => 'Venerable Maestro'],
                ['name' => 'Oswaldo Ramon Rodriguez', 'national_id' => '7880216', 'phone' => '04266914093', 'email' => 'rodriguez_osw@hotmail.com', 'position' => 'Primer Vigilante'],
                ['name' => 'Juan Vicente Trias Lopez', 'national_id' => '8541303', 'phone' => '04169897666', 'email' => 'Juantrias758@gmail.com', 'position' => 'Segundo Vigilante'],
                ['name' => 'Douglas Alfredo Ramirez Gonzalez', 'national_id' => '7226326', 'phone' => '04148860449', 'email' => 'ramirezgdouglas@gmail.com', 'position' => 'Orador Fiscal'],
                ['name' => 'Carlos Guillermo Garcia Macero', 'national_id' => '17162866', 'phone' => '04268192001', 'email' => 'qhmacero@gmail.com', 'position' => 'Secretario Guarda Sello y Timbre'],
                ['name' => 'Jose Manuel Betancourt Torres', 'national_id' => '7248147', 'phone' => '04148545534', 'email' => null, 'position' => 'Primer Experto'],
                ['name' => 'Samir Miguel Nasr Hani', 'national_id' => '13807487', 'phone' => '04148868263', 'email' => 'samirnasr1977@gmail.com', 'position' => 'Segundo Experto'],
                ['name' => 'Robert Ali Salas Moreno', 'national_id' => '20078314', 'phone' => '04249026133', 'email' => 'robertsalas071125@gmail.com', 'position' => 'Primer Maestro de Ceremonias'],
                ['name' => 'Mamadou Kolon Diallo', 'national_id' => '22800204', 'phone' => '04249026133', 'email' => 'jlrodriguezm27@gmail.com', 'position' => 'Segundo Maestro de Ceremonias'],
                ['name' => 'Orlando Alder Oliveira', 'national_id' => '8543169', 'phone' => '04267991372', 'email' => 'turo_sen@hotmail.com', 'position' => 'Tesorero'],
                ['name' => 'Juan Jose Tirado Sotillo', 'national_id' => '8887426', 'phone' => '04148609734', 'email' => 'juantiradomanteco@gmail.com', 'position' => 'Hospitalario'],
                ['name' => 'Edgar Norberto Vivas Alfonso', 'national_id' => '9237347', 'phone' => '04265940389', 'email' => 'egarvivas68@gmail.com', 'position' => 'Primer Diácono'],
                ['name' => 'Orlando Rafael Malave', 'national_id' => '8825252', 'phone' => '04249141965', 'email' => 'mor252@hotmail.com', 'position' => 'Segundo Diácono'],
                ['name' => 'Angel Ramon Valerio Hernandez', 'national_id' => '8338169', 'phone' => '04166972704', 'email' => 'qhvalerio@gmail.com', 'position' => 'Guarda Templo Interior'],
                ['name' => 'Luis Eduardo Yepez Melendez', 'national_id' => '10049364', 'phone' => '04249464374', 'email' => 'qhwicho@gmail.com', 'position' => 'Diputado Suplente'],
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
                        'email' => $memberData['email'],
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
