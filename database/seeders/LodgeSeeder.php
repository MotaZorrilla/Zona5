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
            ['name' => 'Pedro Cova', 'number' => 28, 'orient' => 'Upata', 'foundation_date' => '1885-09-29', 'history' => 'Fundada el 29 de Septiembre de 1885. Regularmente constituida bajo los auspicios de la Muy Resp:. Gran Logia de la República de Venezuela'],
            ['name' => 'Aurora del Yuruari', 'number' => 53, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Dios y Patria', 'number' => 67, 'orient' => 'Tumeremo', 'history' => 'Fundada el 28 de Agosto de 1917 (e:.v:.). Jurisdiccionada a la Muy Resp:. Gran Logia de la República de Venezuela', 'address' => 'Calle Carabobo. Templo Masónico or:. de Tumeremo - Estado Bolívar – Venezuela'],
            ['name' => 'Dalla Costa', 'number' => 75, 'orient' => 'El Callao'],
            ['name' => 'Sol de Imataca', 'number' => 128, 'orient' => 'El Palmar'],
            ['name' => 'Estrella Guzman Blanco', 'number' => 130, 'orient' => 'El Dorado', 'foundation_date' => '1800-06-13'],
            ['name' => 'Luz del Orinoco', 'number' => 161, 'orient' => 'Caicara del Orinoco'],
            ['name' => 'Manuel Piar', 'number' => 164, 'orient' => 'Ciudad Piar'],
            ['name' => 'Domingo Faustino Sarmiento', 'number' => 167, 'orient' => 'Puerto Ordaz', 'history' => 'Fundada el 05 de Junio del 1.966(e∴v∴) e Instalada el 27 de Agosto de 1.966 (e∴v∴). Legalmente Constituida en Ciudad Guayana, Edo. Bolívar – Venezuela. Entidad Autónoma y Soberana, Federada a la Muy Resp∴ Gran Log∴ de la República de Venezuela', 'address' => 'Carrera el Palmar, Edificio Anacaona, Templo Armonía, Cdad. Guayana'],
            ['name' => 'Hans Hauschildt', 'number' => 175, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Estrella de Roraima', 'number' => 188, 'orient' => 'Santa Elena de Uairen'],
            ['name' => 'Dr Cesar Obdulio Iriarte', 'number' => 202, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Salmo 133', 'number' => 209, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Sol de Guayana', 'number' => 218, 'orient' => 'Ciudad Bolívar', 'foundation_date' => '1993-07-12', 'history' => 'Fundada el 12 de julio de 1993 (E.V.) e Instalada el 09 de Agosto de 1993 (E.V.) bajo los auspicios de la Muy Resp:. Gran Logia de La República de Venezuela', 'address' => 'Hotel La Cumbre Ciudad Bolívar – Venezuela', 'email' => 'soldeguayana218@gmail.com'],
            ['name' => 'Juan Francisco Girón', 'number' => 219, 'orient' => 'Upata'],
            ['name' => 'Jesus Valentino Latan La Rosa', 'number' => 220, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Dr. Carlos Rodríguez Jimenez', 'number' => 221, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Luz y Reflexión', 'number' => 223, 'orient' => 'Puerto Ordaz', 'foundation_date' => '1989-10-12'],
            ['name' => 'Congreso de Angostura', 'number' => 224, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Correo del Orinoco', 'number' => 227, 'orient' => 'Ciudad Bolívar', 'history' => 'Elección e Instalación de Dignidades y Oficiales: 29 de enero de 2022 (e.v.)', 'address' => 'Templo Masónico ubicado en la Sede del Hotel La Cumbre Or:. Ciudad Bolívar'],
            ['name' => 'Bolivar y Sucre', 'number' => 228, 'orient' => 'San Félix', 'address' => 'Carrera 5 de Julio, sector El Roble por Fuera, San Félix estado Bolívar'],
            ['name' => 'Justicia y Luz', 'number' => 231, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Estrella del Supamo', 'number' => 232, 'orient' => 'El Manteco'],
            ['name' => 'Rafael Calabrese', 'number' => 241, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Humberto Camejo Arias', 'number' => 251, 'orient' => 'Ciudad Bolívar'],
            ['name' => 'Restauradores del Honor XXII', 'number' => 261, 'orient' => 'Puerto Ordaz', 'foundation_date' => '2013-02-24', 'history' => 'Fundada el 24 de Febrero de 2013 (e.v.) Reinstalada el 30 de Junio de 2018 (e.v.) Regularmente Constituida en la Jurisdicción de la Gran Logia de la República de Venezuela', 'address' => 'Or. de San Félix', 'email' => 'secretario261@granlogia.org.ve'],
            ['name' => 'Estudios Tradicionales', 'number' => 262, 'orient' => 'Puerto Ordaz'],
            ['name' => 'Pedro Antonio Olivieri Grillasca', 'number' => 267, 'orient' => 'Tumeremo'],
            ['name' => 'Carlos Daniel Fernández', 'number' => 270, 'orient' => 'Casacoima', 'foundation_date' => '2019-01-08', 'address' => 'Av. Simón Bolívar, Sector Brisas del Triunfo I, Casa S/N°, Municipio Casacoima, Estado Delta Amacuro.'],
            ['name' => 'Gran Cadena Universal', 'number' => 271, 'orient' => 'San Félix'],
            ['name' => 'Union Fraternal', 'number' => 281, 'orient' => 'Guasipati'],
        ];

        foreach ($lodgesData as $data) {
            Lodge::updateOrCreate(
                ['number' => $data['number']],
                [
                    'name' => $data['name'],
                    'orient' => $data['orient'],
                    'slug' => Str::slug($data['name']),
                    'history' => $data['history'] ?? null,
                    'address' => $data['address'] ?? null,
                    'foundation_date' => $data['foundation_date'] ?? null,
                    'image_url' => null, // Keep other fields as they are or set defaults
                ]
            );
        }
    }
}
