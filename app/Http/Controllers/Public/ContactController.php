<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('public.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full-name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        // Aquí normalmente enviarías un correo electrónico
        // Por ahora vamos a simular que se envió correctamente
        
        // En una implementación real, enviarías un correo:
        /*
        Mail::raw("Nuevo mensaje de contacto:\n\nNombre: {$request->input('full-name')}\nEmail: {$request->input('email')}\nTeléfono: {$request->input('phone')}\nMensaje: {$request->input('message')}", function ($message) {
            $message->to('contacto@granlogia.org.ve')
                    ->subject('Nuevo mensaje de contacto desde el sitio web');
        });
        */

        return redirect()->route('public.contact')->with('success', '¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.');
    }
}