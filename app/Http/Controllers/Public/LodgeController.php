<?php

namespace App\Http\Controllers\Public; // Nota: Namespace cambiado a Public

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LodgeController extends Controller
{
    /**
     * Muestra la página de detalle de una logia específica.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        // Lógica para encontrar la logia por su slug (a futuro)
        // Por ahora, usamos datos de maqueta.
        $lodge = [
            'name' => ucwords(str_replace('-', ' ', $slug)),
            'valley' => 'Valle de Ciudad Guayana',
            'image' => 'https://picsum.photos/seed/' . $slug . '/1920/1080',
            'history' => 'Aquí va la historia detallada de la logia ' . ucwords(str_replace('-', ' ', $slug)) . '. Es un relato de su fundación, sus miembros ilustres y su contribución a la masonería y a la sociedad local a lo largo de los años.',
            'dignitaries' => [
                ['role' => 'Venerable Maestro', 'name' => 'Juan Pérez'],
                ['role' => 'Primer Vigilante', 'name' => 'Carlos Rodríguez'],
                ['role' => 'Segundo Vigilante', 'name' => 'Pedro Gómez'],
                ['role' => 'Orador Fiscal', 'name' => 'Luis Acosta'],
                ['role' => 'Secretario', 'name' => 'José Castillo'],
            ],
            'events' => [
                ['date' => '2025-10-10', 'name' => 'Tenida Ordinaria'],
                ['date' => '2025-10-24', 'name' => 'Tenida de Aniversario'],
                ['date' => '2025-11-14', 'name' => 'Tenida de Elecciones'],
            ]
        ];

        return view('public.lodge-show', compact('lodge'));
    }
}
