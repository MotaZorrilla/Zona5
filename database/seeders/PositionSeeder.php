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
            'Secretario',
            'Tesorero',
            'Maestro de Ceremonias',
            'Guarda Templo Interior',
            'Miembro',
            // Zonal Positions
            'Secretario de la Zona 5',
        ];

        foreach ($positions as $position) {
            Position::firstOrCreate(['name' => $position]);
        }
    }
}