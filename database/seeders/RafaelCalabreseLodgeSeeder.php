<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Lodge;
use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RafaelCalabreseLodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberRole = Role::where('name', 'User')->first();
        $memberPosition = Position::where('name', 'Miembro')->first();

        $lodge = Lodge::where('name', 'Rafael Calabrese')->first();

        if ($lodge) {
            $membersData = [
                ['name' => 'Tomas Domingo Clark Castro', 'national_id' => '13507985', 'phone' => '0414-8025978', 'degree' => 'Maestro', 'position' => 'Venerable Maestro', 'profession' => 'Abogado'],
                ['name' => 'Carlos José Mera Herrera', 'national_id' => '8869219', 'phone' => '0426-9841334', 'degree' => 'Maestro', 'position' => 'Primer Vigilante', 'profession' => 'Ing. Mecánico'],
                ['name' => 'Fernando Miguel Gómes Cedeño', 'national_id' => '17161274', 'phone' => '0424-9053971', 'degree' => 'Maestro', 'position' => 'Segundo Vigilante', 'profession' => 'Abogado'],
                ['name' => 'Felix Ramón Tenepesame Valor', 'national_id' => '8872262', 'phone' => '0414-7653654', 'degree' => 'Maestro', 'position' => 'Orador Fiscal', 'profession' => 'Licdo. Administración'],
                ['name' => 'Rafael Antonio Correa Sánchez', 'national_id' => '10571573', 'phone' => '0414 8755869', 'degree' => 'Maestro', 'position' => 'Secretario Guarda Sello y Timbre', 'profession' => 'Tsu Electricidad'],
                ['name' => 'Juan Jose Colmenares Suarez', 'national_id' => '13658022', 'degree' => 'Maestro', 'position' => 'Primer Experto', 'profession' => 'Ing Geologo'],
                ['name' => 'Wilis Delvalle Castillo Torres', 'national_id' => '15617300', 'degree' => 'Maestro', 'position' => 'Primer Maestro de Ceremonias', 'profession' => 'Abogado'],
                ['name' => 'Servio Ramon Leon Silveira', 'national_id' => '5340798', 'degree' => 'Maestro', 'position' => 'Segundo Maestro de Ceremonias', 'profession' => 'Comerciante'],
                ['name' => 'Hiram Jose Moreno Bravo', 'national_id' => '10044839', 'degree' => 'Maestro', 'position' => 'Tesorero', 'profession' => 'Farmaceuta'],
                ['name' => 'Willian Ronald Caña Gil', 'national_id' => '13156854', 'degree' => 'Maestro', 'position' => 'Guarda Templo Interior', 'profession' => 'Ing Electrico'],
                ['name' => 'Marcos Enrique Mera Herrera', 'national_id' => '5555468', 'degree' => 'Maestro', 'position' => 'Miembro', 'profession' => 'Sociologo'],
                ['name' => 'Alejandro Jose Torres Guzman', 'national_id' => '14652973', 'degree' => 'Compañero', 'position' => 'Miembro', 'profession' => 'Comerciante'],
                ['name' => 'Jose Gregorio Ortega Rondon', 'national_id' => '11173303', 'degree' => 'Compañero', 'position' => 'Miembro', 'profession' => 'Abogado'],
                ['name' => 'José Antonio Flores Rodríguez', 'national_id' => '5985937', 'degree' => 'Compañero', 'position' => 'Miembro', 'profession' => 'Ing. Mantenimiento'],
                ['name' => 'Julio Cesar Rivero Rodriguez', 'national_id' => '15372977', 'degree' => 'Aprendiz', 'position' => 'Miembro', 'profession' => 'Lic. Adm de empresas'],
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
                        'email' => null,
                        'password' => Hash::make('password'),
                        'degree' => $memberData['degree'],
                        'phone_number' => $memberData['phone'] ?? null,
                        'profession' => $memberData['profession'] ?? null,
                    ]
                );

                $user->roles()->syncWithoutDetaching([$memberRole->id]);

                $positionId = $positionsMap[$memberData['position']] ?? $memberPosition->id;
                $user->lodges()->syncWithoutDetaching([$lodge->id => ['position_id' => $positionId]]);
            }
        }
    }
}
