<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ContentManagerController extends Controller
{
    /**
     * Muestra la sección solicitada del gestor de contenido.
     *
     * @param  string  $section
     * @return \Illuminate\View\View
     */
    public function show($section = 'general')
    {
        $viewPath = 'admin.content-manager.' . $section;

        if (!View::exists($viewPath)) {
            abort(404);
        }

        // Array de secciones para la navegación
        $sections = [
            'general' => 'General',
            'home' => 'Página de Inicio',
            'about' => 'Quiénes Somos',
            'lodges' => 'Logias',
            'resources' => 'Recursos',
            'news' => 'Noticias',
            'contact' => 'Contacto',
        ];

        return view('admin.content-manager', [
            'currentSection' => $section,
            'sections' => $sections,
            'sectionView' => $viewPath
        ]);
    }

    /**
     * Actualiza la configuración de contacto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateContact(Request $request)
    {
        $request->validate([
            'contact_page_title' => 'required|string|max:255',
            'contact_page_subtitle' => 'required|string|max:500',
            'contact_banner_image' => 'required|url|max:500',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string|max:500',
            'contact_hours' => 'nullable|string|max:250',
            'contact_show_form' => 'boolean',
            'contact_show_map' => 'boolean',
            'contact_show_info' => 'boolean',
            'contact_form_enabled' => 'boolean',
        ]);

        // Configuración de la página
        Setting::set('contact_page_title', $request->contact_page_title);
        Setting::set('contact_page_subtitle', $request->contact_page_subtitle);
        Setting::set('contact_banner_image', $request->contact_banner_image);

        // Configuración de contacto
        Setting::set('contact_email', $request->contact_email);
        Setting::set('contact_phone', $request->contact_phone);
        Setting::set('contact_address', $request->contact_address);
        Setting::set('contact_hours', $request->contact_hours);

        // Opciones de visualización
        Setting::set('contact_show_form', $request->boolean('contact_show_form'));
        Setting::set('contact_show_map', $request->boolean('contact_show_map'));
        Setting::set('contact_show_info', $request->boolean('contact_show_info'));
        Setting::set('contact_form_enabled', $request->boolean('contact_form_enabled'));

        return redirect()->route('admin.content-manager.show', 'contact')
                        ->with('success', 'Configuración de contacto actualizada correctamente');
    }
}
