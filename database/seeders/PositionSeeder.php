<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            'Venerable Maestro',
            'Primer Vigilante',
            'Segundo Vigilante',
            'Orador Fiscal',
            'Secretario Guarda Sello y Timbre',
            'Tesorero',
            'Guarda Templo Interior',
            'Miembro',
            'Hospitalario',
            'Primer Experto',
            'Segundo Experto',
            'Primer Diácono',
            'Segundo Diácono',
            'Venerable Maestro Ad Vitam',
            'Ex Venerable Maestro',
            'Secretario Adjunto',
            'Miembro Honorario',
            'Orador Fiscal Adjunto',
            'Primer Diputado',
            'Segundo Diputado',
            'Diputado Suplente',
            'Primer Maestro de Ceremonias',
            'Segundo Maestro de Ceremonias',
            'Maestro Banquete',
            'Secretario Guarda Sello y Timbre Adjunto',
        ];

        foreach ($positions as $position) {
            Position::firstOrCreate(['name' => $position]);
        }
    }
}