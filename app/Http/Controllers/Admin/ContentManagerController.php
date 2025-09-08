<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
