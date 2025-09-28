<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index()
    {
        $generalSettings = [
            'site_name' => Setting::get('site_name', config('app.name', 'Gran Zona 5 - GLRV')),
            'site_description' => Setting::get('site_description', 'Portal administrativo y público de la Gran Zona 5.'),
            'site_email' => Setting::get('site_email', 'contacto@granzona5.org'),
            'site_phone' => Setting::get('site_phone', '+58-XXX-XXXX'),
            'maintenance_mode' => Setting::get('maintenance_mode', false),
            'timezone' => Setting::get('timezone', config('app.timezone', 'America/Caracas')),
        ];

        $contactSettings = [
            'contact_email' => Setting::get('contact_email', 'contacto@granzona5.org'),
            'contact_phone' => Setting::get('contact_phone', '+58-XXX-XXXX'),
            'contact_address' => Setting::get('contact_address', 'Dirección de la Gran Zona 5'),
            'contact_hours' => Setting::get('contact_hours', 'Lunes a Viernes, 9:00 AM - 5:00 PM'),
        ];

        $footerSettings = [
            'footer_copyright' => Setting::get('footer_copyright', '© 2025 Gran Zona 5. Todos los derechos reservados.'),
            'footer_links' => Setting::get('footer_links', [
                ['name' => 'Quiénes Somos', 'url' => '/about-us'],
                ['name' => 'Logias', 'url' => '/lodges'],
                ['name' => 'Contacto', 'url' => '/contact']
            ]),
        ];

        return view('admin.settings', compact('generalSettings', 'contactSettings', 'footerSettings'));
    }

    public function update(Request $request)
    {
        $section = $request->input('section', 'general');
        
        switch ($section) {
            case 'general':
                return $this->updateGeneralSettings($request);
            case 'contact':
                return $this->updateContactSettings($request);
            case 'footer':
                return $this->updateFooterSettings($request);
            default:
                return redirect()->route('admin.settings.index')->with('error', 'Sección no válida');
        }
    }

    private function updateGeneralSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'required|string|max:500',
            'site_email' => 'required|email|max:255',
            'site_phone' => 'nullable|string|max:20',
            'maintenance_mode' => 'boolean',
            'timezone' => 'required|string|max:50',
        ]);

        // Actualizar la configuración general
        Setting::set('site_name', $request->site_name);
        Setting::set('site_description', $request->site_description);
        Setting::set('site_email', $request->site_email);
        Setting::set('site_phone', $request->site_phone);
        Setting::set('maintenance_mode', $request->maintenance_mode ?? false);
        Setting::set('timezone', $request->timezone);

        // Si hay un logo para subir
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            Setting::set('site_logo', $logoPath);
        }

        return redirect()->route('admin.settings.index')->with('success', 'Configuración general actualizada correctamente');
    }

    private function updateContactSettings(Request $request)
    {
        $request->validate([
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string|max:500',
            'contact_hours' => 'nullable|string|max:250',
        ]);

        Setting::set('contact_email', $request->contact_email);
        Setting::set('contact_phone', $request->contact_phone);
        Setting::set('contact_address', $request->contact_address);
        Setting::set('contact_hours', $request->contact_hours);

        return redirect()->route('admin.settings.index')->with('success', 'Configuración de contacto actualizada correctamente');
    }

    private function updateFooterSettings(Request $request)
    {
        $request->validate([
            'footer_copyright' => 'required|string|max:500',
            'footer_links' => 'array',
            'footer_links.*.name' => 'required_with:footer_links.*.url|string|max:100',
            'footer_links.*.url' => 'required_with:footer_links.*.name|url|max:255',
        ]);

        $footerLinks = [];
        if ($request->has('footer_links.name') && $request->has('footer_links.url')) {
            $names = $request->input('footer_links.name');
            $urls = $request->input('footer_links.url');
            
            for ($i = 0; $i < count($names); $i++) {
                if (!empty($names[$i]) && !empty($urls[$i])) {
                    $footerLinks[] = [
                        'name' => $names[$i],
                        'url' => $urls[$i]
                    ];
                }
            }
        }

        Setting::set('footer_copyright', $request->footer_copyright);
        Setting::set('footer_links', $footerLinks);

        return redirect()->route('admin.settings.index')->with('success', 'Configuración de pie de página actualizada correctamente');
    }
}