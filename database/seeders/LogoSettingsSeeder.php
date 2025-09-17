<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class LogoSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener los archivos de logo de la carpeta pública
        $logoFiles = \File::files(public_path('uploads/logos'));
        
        if (!empty($logoFiles)) {
            // Usar el primer archivo como logo principal
            $logoPath = 'uploads/logos/' . $logoFiles[0]->getFilename();
            
            // Actualizar o crear la configuración del logo del sitio
            Setting::updateOrCreate(
                ['key' => 'site_logo'],
                ['value' => $logoPath]
            );
            
            // Actualizar o crear la configuración del favicon
            Setting::updateOrCreate(
                ['key' => 'favicon'],
                ['value' => $logoPath]
            );
            
            echo "Logo settings updated successfully!\n";
            echo "Logo path: " . $logoPath . "\n";
        } else {
            echo "No logo files found in public/uploads/logos/\n";
        }
    }
}