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
            ['name' => 'Presidente', 'description' => 'Presidente de la Gran Zona 5'],
            ['name' => 'Vicepresidente', 'description' => 'Vicepresidente de la Gran Zona 5'],
            ['name' => 'Secretario', 'description' => 'Secretario de la Gran Zona 5'],
            ['name' => 'Tesorero', 'description' => 'Tesorero de la Gran Zona 5'],
            ['name' => 'Venerable Maestro', 'description' => 'Venerable Maestro de una Logia'],
            ['name' => 'Primer Vigilante', 'description' => 'Primer Vigilante de una Logia'],
            ['name' => 'Segundo Vigilante', 'description' => 'Segundo Vigilante de una Logia'],
        ];

        foreach ($positions as $positionData) {
            Position::updateOrCreate(
                ['name' => $positionData['name']],
                $positionData
            );
        }
    }
}