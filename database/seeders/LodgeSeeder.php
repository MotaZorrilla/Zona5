<?php

namespace Database\Seeders;

use App\Models\Lodge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LodgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lodge::create(['name' => 'Domingo Faustino Sarmiento', 'number' => 1, 'oriente' => 'Puerto Ordaz', 'slug' => 'domingo-faustino-sarmiento']);
        Lodge::create(['name' => 'Hanhoushing', 'number' => 2, 'oriente' => 'Puerto Ordaz', 'slug' => 'hanhoushing']);
        Lodge::create(['name' => 'Asilo de la Paz', 'number' => 13, 'oriente' => 'Ciudad Bolívar', 'slug' => 'asilo-de-la-paz']);
    }
}