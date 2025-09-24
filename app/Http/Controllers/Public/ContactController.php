<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        return view('public.contact');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full-name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        // Obtener el primer usuario administrador como destinatario
        // En una implementación real, podrías enviarlo a un grupo específico o a varios administradores
        $adminUser = User::first(); // O podrías usar una lógica más específica para determinar el destinatario

        if (!$adminUser) {
            // Si no hay usuarios en el sistema, redirigir con error
            return redirect()->route('public.contact')->with('error', 'Lo sentimos, hubo un problema al procesar tu mensaje. Por favor, inténtalo más tarde.');
        }

        // Crear el mensaje en la base de datos
        Message::create([
            'sender_name' => $validatedData['full-name'],
            'sender_email' => $validatedData['email'],
            'subject' => 'Mensaje de contacto desde el sitio web',
            'content' => "Nombre: {$validatedData['full-name']}\nEmail: {$validatedData['email']}\nTeléfono: " . ($validatedData['phone'] ?? 'No proporcionado') . "\n\nMensaje:\n{$validatedData['message']}",
            'recipient_id' => $adminUser->id,
            'status' => 'unread',
        ]);

        // Aquí normalmente también enviarías un correo electrónico de notificación
        // Por ahora vamos a comentarlo para no complicar la implementación
        /*
        Mail::raw("Nuevo mensaje de contacto:\n\nNombre: {$validatedData['full-name']}\nEmail: {$validatedData['email']}\nTeléfono: " . ($validatedData['phone'] ?? 'No proporcionado') . "\n\nMensaje:\n{$validatedData['message']}", function ($message) use ($validatedData) {
            $message->to('contacto@granlogia.org.ve')
                    ->subject('Nuevo mensaje de contacto desde el sitio web');
        });
        */

        return redirect()->route('public.contact')->with('success', '¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.');
    }
}