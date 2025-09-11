<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZoneDignitariesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dignitaries = [
            ['name' => 'Luis Bartolo Ramírez', 'role' => 'Presidente'],
            ['name' => 'Henry Jiménez', 'role' => 'Presidente Adjunto'],
            ['name' => 'Enrique Exposito', 'role' => 'Vicepresidente'],
            ['name' => 'Roque La Torre', 'role' => 'Vice Presedente Adjunto'],
            ['name' => 'José Boada', 'role' => 'Orador'],
            ['name' => 'Héctor Mota', 'role' => 'Coordinador de Informática y Medios Digitales'],
            ['name' => 'Carlos Larreal', 'role' => 'Secretario'],
            ['name' => 'Eduardo Guzmán', 'role' => 'Secretario Adjunto'],
            ['name' => 'Alfonzo Herrrra', 'role' => 'Delegado'],
            ['name' => 'Reinaldo Mendires', 'role' => 'Delegado'],
            ['name' => 'Félix Pinto', 'role' => 'Delegado'],
            ['name' => 'Wilfredo Arzolay', 'role' => 'Delegado'],
            ['name' => 'Osman García', 'role' => 'Delegado'],
            ['name' => 'Edgar Liconti', 'role' => 'Delegado'],
        ];

        foreach ($dignitaries as $dignitary) {
            DB::table('zone_dignitaries')->insertOrIgnore([
                'name' => $dignitary['name'],
                'role' => $dignitary['role'],
                'image_url' => null, // Default value
                'bio' => null, // Default value
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
