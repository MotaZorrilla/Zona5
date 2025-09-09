<?php

namespace Database\Seeders;

use App\Models\Lodge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class LodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lodgesData = [
            ['name' => 'Asilo de la Paz', 'number' => 13, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Pedro Cova', 'number' => 28, 'orient' => 'Upata'],
            ['name' => 'Aurora del Yuruari', 'number' => 53, 'orient' => 'San Felix'],
            ['name' => 'Dios y Patria', 'number' => 67, 'orient' => 'Tumeremo'],
            ['name' => 'Modalla Costa', 'number' => 75, 'orient' => 'El Callao'],
            ['name' => 'Sol de Imataca', 'number' => 128, 'orient' => 'El Palmar'],
            ['name' => 'Estrella Guzman Blanco', 'number' => 130, 'orient' => 'El Dorado'],
            ['name' => 'Luz del Orinoco', 'number' => 161, 'orient' => 'Caicara del Orinoco'],
            ['name' => 'Manuel Piar', 'number' => 164, 'orient' => 'Ciudad Piar'],
            ['name' => 'Domingo Faustino Sarmiento', 'number' => 167, 'orient' => 'Ciudad Guayana'],
            ['name' => 'Hans Hauschildt', 'number' => 175, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Estrella de Roraima', 'number' => 188, 'orient' => 'Santa Elena de Uairen'],
            ['name' => 'Dr Cesar Obdulio Iriarte', 'number' => 202, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Salmo 133', 'number' => 209, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Sol de Guayana', 'number' => 218, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Juan Francisco Giron', 'number' => 219, 'orient' => 'Upata'],
            ['name' => 'Jesus Valentino Latan La Rosa', 'number' => 220, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Dr. Carlos Rodríguez Jimenez', 'number' => 221, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Luz y Reflexión', 'number' => 223, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Congreso de Angostura', 'number' => 224, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Correo del Orinoco', 'number' => 227, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Bolivar y Sucre', 'number' => 228, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Justicia y Luz', 'number' => 231, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Estrella del Supamo', 'number' => 232, 'orient' => 'El Manteco'],
            ['name' => 'Rafael Calabrese', 'number' => 241, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Humberto Camejo Arias', 'number' => 251, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Restauradores del Honor XXII', 'number' => 261, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Estudios Tradicionales', 'number' => 262, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Pedro Antonio Olivieri Grillasca', 'number' => 267, 'orient' => 'Tumeremo'],
            ['name' => 'Carlos Daniel Fernandez', 'number' => 270, 'orient' => 'Casacoima'],
            ['name' => 'Gran Cadena Universal', 'number' => 271, 'orient' => 'Puerto Ordaz'],
        ];

        foreach ($lodgesData as $data) {
            Lodge::updateOrCreate(
                ['number' => $data['number']], // Find lodge by its unique number
                [
                    'name' => $data['name'],
                    'orient' => $data['orient'],
                    'slug' => Str::slug($data['name']),
                    // other fields can be set to null or default values if not in $data
                    'history' => null,
                    'image_url' => null,
                    'address' => null,
                ]
            );
        }
    }
}