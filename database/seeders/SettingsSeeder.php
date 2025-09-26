<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Configuración general del sitio
        Setting::updateOrCreate(
            ['key' => 'site_name'],
            [
                'value' => 'Gran Zona 5 - GLRV',
                'type' => 'string',
                'description' => 'Nombre del sitio web'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'site_description'],
            [
                'value' => 'Portal administrativo y público de la Gran Zona 5.',
                'type' => 'text',
                'description' => 'Descripción corta del sitio'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'site_email'],
            [
                'value' => 'contacto@granzona5.org',
                'type' => 'string',
                'description' => 'Email principal de contacto'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'site_phone'],
            [
                'value' => '+58-XXX-XXXX',
                'type' => 'string',
                'description' => 'Teléfono principal de contacto'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'maintenance_mode'],
            [
                'value' => 'false',
                'type' => 'boolean',
                'description' => 'Indica si el sitio está en modo mantenimiento'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'timezone'],
            [
                'value' => 'America/Caracas',
                'type' => 'string',
                'description' => 'Zona horaria predeterminada'
            ]
        );

        // Configuración de contacto
        Setting::updateOrCreate(
            ['key' => 'contact_email'],
            [
                'value' => 'contacto@granzona5.org',
                'type' => 'string',
                'description' => 'Email para contacto general'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'contact_phone'],
            [
                'value' => '+58-XXX-XXXX',
                'type' => 'string',
                'description' => 'Teléfono para contacto general'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'contact_address'],
            [
                'value' => 'Dirección de la Gran Zona 5',
                'type' => 'text',
                'description' => 'Dirección física para contacto'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'contact_hours'],
            [
                'value' => 'Lunes a Viernes, 9:00 AM - 5:00 PM',
                'type' => 'string',
                'description' => 'Horario de contacto'
            ]
        );

        // Configuración de pie de página
        Setting::updateOrCreate(
            ['key' => 'footer_copyright'],
            [
                'value' => json_encode('© 2025 Gran Zona 5. Todos los derechos reservados.'),
                'type' => 'json',
                'description' => 'Texto de copyright del pie de página'
            ]
        );

        Setting::updateOrCreate(
            ['key' => 'footer_links'],
            [
                'value' => json_encode([
                    ['name' => 'Quiénes Somos', 'url' => '/about-us'],
                    ['name' => 'Logias', 'url' => '/lodges'],
                    ['name' => 'Contacto', 'url' => '/contact']
                ]),
                'type' => 'json',
                'description' => 'Enlaces del pie de página'
            ]
        );
    }
}