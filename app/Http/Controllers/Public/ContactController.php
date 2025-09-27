<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        // Obtener configuración de contacto desde el sistema de settings
        $contactSettings = [
            'contact_email' => Setting::get('contact_email', 'contacto@granzona5.org'),
            'contact_phone' => Setting::get('contact_phone', '+58-XXX-XXXX'),
            'contact_address' => Setting::get('contact_address', 'Gran Logia de la República de Venezuela<br>Caracas, Distrito Capital'),
            'contact_hours' => Setting::get('contact_hours', 'Lunes a Viernes, 9:00 AM - 5:00 PM'),
            'show_form' => Setting::get('contact_show_form', true),
            'show_map' => Setting::get('contact_show_map', true),
            'show_info' => Setting::get('contact_show_info', true),
        ];

        // Configuración de la página
        $pageSettings = [
            'title' => Setting::get('contact_page_title', 'Ponte en Contacto'),
            'subtitle' => Setting::get('contact_page_subtitle', '¿Tienes alguna pregunta o quieres saber más sobre nosotros? No dudes en contactarnos.'),
            'banner_image' => Setting::get('contact_banner_image', 'https://picsum.photos/seed/contact-hero/1920/1080'),
        ];

        return view('public.contact', compact('contactSettings', 'pageSettings'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full-name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        // Usar el email configurado en el sistema de settings
        $recipientEmail = Setting::get('contact_email', 'contacto@granzona5.org');

        // Crear el mensaje en la base de datos sin destinatario específico
        // ya que ahora usamos el email configurado en settings
        Message::create([
            'sender_name' => $validatedData['full-name'],
            'sender_email' => $validatedData['email'],
            'subject' => 'Mensaje de contacto desde el sitio web',
            'content' => "Nombre: {$validatedData['full-name']}\nEmail: {$validatedData['email']}\nTeléfono: " . ($validatedData['phone'] ?? 'No proporcionado') . "\n\nMensaje:\n{$validatedData['message']}",
            'recipient_id' => null, // No asignamos destinatario específico
            'status' => 'unread',
        ]);

        // Enviar correo electrónico de notificación usando el email configurado
        try {
            Mail::raw("Nuevo mensaje de contacto:\n\nNombre: {$validatedData['full-name']}\nEmail: {$validatedData['email']}\nTeléfono: " . ($validatedData['phone'] ?? 'No proporcionado') . "\n\nMensaje:\n{$validatedData['message']}", function ($message) use ($recipientEmail, $validatedData) {
                $message->to($recipientEmail)
                        ->subject('Nuevo mensaje de contacto desde el sitio web');
            });
        } catch (\Exception $e) {
            // Si hay error enviando el email, continuar sin él
            // El mensaje ya está guardado en la base de datos
        }

        return redirect()->route('public.contact')->with('success', '¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.');
    }
}