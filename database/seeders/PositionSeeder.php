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
            ['name' => 'Orador Fiscal', 'description' => 'Orador Fiscal de una Logia'],
            ['name' => 'Secretario Guarda Sello y Timbre', 'description' => 'Secretario Guarda Sello y Timbre de una Logia'],
            ['name' => 'Tesorero', 'description' => 'Tesorero de una Logia'],
            ['name' => 'Hospitalario', 'description' => 'Hospitalario de una Logia'],
            ['name' => 'Guarda Templo Interior', 'description' => 'Guarda Templo Interior de una Logia'],
            ['name' => 'Primer Maestro de Ceremonias', 'description' => 'Primer Maestro de Ceremonias de una Logia'],
            ['name' => 'Segundo Experto', 'description' => 'Segundo Experto de una Logia'],
            ['name' => 'Primer Experto', 'description' => 'Primer Experto de una Logia'],
            ['name' => 'Miembro', 'description' => 'Miembro de una Logia'],
            ['name' => 'Primer Diácono', 'description' => 'Primer Diácono de una Logia'],
            ['name' => 'Segundo Diácono', 'description' => 'Segundo Diácono de una Logia'],
            ['name' => 'Venerable Maestro Ad Vitam', 'description' => 'Venerable Maestro Ad Vitam de una Logia'],
            ['name' => 'Ex Venerable Maestro', 'description' => 'Ex Venerable Maestro de una Logia'],
            ['name' => 'Secretario Adjunto', 'description' => 'Secretario Adjunto de una Logia'],
            ['name' => 'Orador Fiscal Adjunto', 'description' => 'Orador Fiscal Adjunto de una Logia'],
            ['name' => 'Primer Diputado', 'description' => 'Primer Diputado de una Logia'],
            ['name' => 'Segundo Diputado', 'description' => 'Segundo Diputado de una Logia'],
            ['name' => 'Diputado Suplente', 'description' => 'Diputado Suplente de una Logia'],
            ['name' => 'Segundo Maestro de Ceremonias', 'description' => 'Segundo Maestro de Ceremonias de una Logia'],
            ['name' => 'Maestro Banquete', 'description' => 'Maestro Banquete de una Logia'],
            ['name' => 'Secretario Guarda Sello y Timbre Adjunto', 'description' => 'Secretario Guarda Sello y Timbre Adjunto de una Logia'],
        ];

        foreach ($positions as $positionData) {
            Position::updateOrCreate(
                ['name' => $positionData['name']],
                $positionData
            );
        }
    }
}