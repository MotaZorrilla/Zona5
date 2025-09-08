<?php

namespace App\Http\Controllers\Public; // Nota: Namespace cambiado a Public

use App\Http\Controllers\Controller;
use App\Models\Lodge; // Importar el modelo Lodge
use Illuminate\Http\Request;

class LodgeController extends Controller
{
    /**
     * Muestra la página de detalle de una logia específica.
     *
     * @param  \App\Models\Lodge  $lodge
     * @return \Illuminate\View\View
     */
    public function show(Lodge $lodge)
    {
        // Cargar la relación de usuarios (dignatarios y miembros) de la logia.
        $lodge->load('users');

        // Pasar la logia encontrada a la vista.
        return view('public.lodge-show', compact('lodge'));
    }
}
