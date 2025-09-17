<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class FixLogosCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logos:fix';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix logo paths and update settings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Verifying logo files...');
        
        // Verificar archivos en la carpeta de logos
        $logoFiles = Storage::disk('public')->files('logos');
        
        if (empty($logoFiles)) {
            $this->warn('No logo files found in public/uploads/logos/');
            return;
        }
        
        $this->info('Found logo files:');
        foreach ($logoFiles as $file) {
            $this->line('- ' . $file);
        }
        
        // Verificar configuración actual
        $logoSetting = Setting::where('key', 'site_logo')->first();
        $faviconSetting = Setting::where('key', 'favicon')->first();
        
        $this->info("\nCurrent settings:");
        $this->line('Site logo: ' . ($logoSetting ? $logoSetting->value : 'Not set'));
        $this->line('Favicon: ' . ($faviconSetting ? $faviconSetting->value : 'Not set'));
        
        // Si hay archivos de logo, actualizar la configuración
        if (!empty($logoFiles)) {
            $logoPath = $logoFiles[0]; // Usar el primer archivo como logo principal
            
            if (!$logoSetting) {
                Setting::create([
                    'key' => 'site_logo',
                    'value' => $logoPath
                ]);
                $this->info('Created site_logo setting with: ' . $logoPath);
            } else {
                $logoSetting->update(['value' => $logoPath]);
                $this->info('Updated site_logo setting to: ' . $logoPath);
            }
            
            if (!$faviconSetting) {
                Setting::create([
                    'key' => 'favicon',
                    'value' => $logoPath
                ]);
                $this->info('Created favicon setting with: ' . $logoPath);
            } else {
                $faviconSetting->update(['value' => $logoPath]);
                $this->info('Updated favicon setting to: ' . $logoPath);
            }
        }
        
        $this->info('Logo fix completed successfully!');
    }
}