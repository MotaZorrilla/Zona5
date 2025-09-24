<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        // Obtener todos los mensajes recibidos, ordenados por fecha de creación
        $messages = Message::with('recipient')
            ->where('recipient_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Separar mensajes por estado
        $unread = Message::where('recipient_id', Auth::id())->unread()->get();
        $read = Message::where('recipient_id', Auth::id())->read()->get();
        $archived = Message::where('recipient_id', Auth::id())->archived()->get();

        return view('admin.messages.index', compact('messages', 'unread', 'read', 'archived'));
    }

    public function show(Message $message)
    {
        // Verificar que el mensaje sea para el usuario actual
        if ($message->recipient_id !== Auth::id()) {
            return redirect()->route('admin.messages.index')->with('error', 'No tienes permiso para ver este mensaje.');
        }

        // Marcar el mensaje como leído si es para el usuario actual
        if ($message->isUnread()) {
            $message->markAsRead();
        }

        return view('admin.messages.show', compact('message'));
    }

    public function create()
    {
        // Obtener todos los usuarios excepto el actual para enviar mensajes
        $users = User::where('id', '!=', Auth::id())->get();
        return view('admin.messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:users,id|different:' . Auth::id(),
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Message::create([
            'sender_name' => Auth::user()->name,
            'sender_email' => Auth::user()->email,
            'subject' => $request->subject,
            'content' => $request->content,
            'recipient_id' => $request->recipient_id,
            'status' => 'unread',
        ]);

        return redirect()->route('admin.messages.index')->with('success', 'Mensaje enviado exitosamente.');
    }

    public function destroy(Message $message)
    {
        // Solo permitir eliminar mensajes que sean del usuario actual
        if ($message->recipient_id === Auth::id()) {
            $message->update(['status' => 'deleted']);
            return redirect()->route('admin.messages.index')->with('success', 'Mensaje eliminado exitosamente.');
        }

        return redirect()->route('admin.messages.index')->with('error', 'No tienes permiso para eliminar este mensaje.');
    }

    public function archive(Message $message)
    {
        // Solo permitir archivar mensajes que sean del usuario actual
        if ($message->recipient_id === Auth::id()) {
            $message->archive();
            return redirect()->route('admin.messages.index')->with('success', 'Mensaje archivado exitosamente.');
        }

        return redirect()->route('admin.messages.index')->with('error', 'No tienes permiso para archivar este mensaje.');
    }

    public function unread(Message $message)
    {
        // Solo permitir marcar como no leído mensajes que sean del usuario actual
        if ($message->recipient_id === Auth::id()) {
            $message->markAsUnread();
            return redirect()->route('admin.messages.show', $message)->with('success', 'Mensaje marcado como no leído.');
        }

        return redirect()->route('admin.messages.index')->with('error', 'No tienes permiso para modificar este mensaje.');
    }
}
