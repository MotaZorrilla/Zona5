<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $query = Message::with('recipient')
            ->where('recipient_id', Auth::id())
            ->whereIn('status', ['unread', 'read']); // Solo mostrar mensajes no eliminados

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('subject', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('sender_name', 'LIKE', "%{$search}%");
            });
        }

        // Apply date filter
        if ($request->filled('date_from') || $request->filled('date_to')) {
            if ($request->filled('date_from')) {
                $query->where('created_at', '>=', $request->date_from . ' 00:00:00');
            }
            if ($request->filled('date_to')) {
                $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
            }
        }

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $messages = $query->orderBy('created_at', 'desc')->paginate(10)->appends(request()->query());

        return view('admin.messages.index', compact('messages'));
    }

    public function archived(Request $request)
    {
        $query = Message::with('recipient')
            ->where('recipient_id', Auth::id())
            ->archived();

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('subject', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('sender_name', 'LIKE', "%{$search}%");
            });
        }

        // Apply date filter
        if ($request->filled('date_from') || $request->filled('date_to')) {
            if ($request->filled('date_from')) {
                $query->where('created_at', '>=', $request->date_from . ' 00:00:00');
            }
            if ($request->filled('date_to')) {
                $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
            }
        }

        $messages = $query->orderBy('archived_at', 'desc')->paginate(10)->appends(request()->query());

        return view('admin.messages.archived', compact('messages'));
    }

    public function deleted(Request $request)
    {
        $query = Message::with('recipient')
            ->where('recipient_id', Auth::id())
            ->onlyTrashed();

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('subject', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('sender_name', 'LIKE', "%{$search}%");
            });
        }

        // Apply date filter
        if ($request->filled('date_from') || $request->filled('date_to')) {
            if ($request->filled('date_from')) {
                $query->where('created_at', '>=', $request->date_from . ' 00:00:00');
            }
            if ($request->filled('date_to')) {
                $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
            }
        }

        $messages = $query->orderBy('deleted_at', 'desc')->paginate(10)->appends(request()->query());

        return view('admin.messages.deleted', compact('messages'));
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
            $message->delete(); // Soft delete
            return redirect()->route('admin.messages.index')->with('success', 'Mensaje eliminado exitosamente.');
        }

        return redirect()->route('admin.messages.index')->with('error', 'No tienes permiso para eliminar este mensaje.');
    }

    public function restore(Message $message)
    {
        // Solo permitir restaurar mensajes que sean del usuario actual
        if ($message->recipient_id === Auth::id()) {
            $message->restore(); // Restore from soft delete
            $message->update(['status' => 'unread']);
            return redirect()->back()->with('success', 'Mensaje restaurado exitosamente.');
        }

        return redirect()->back()->with('error', 'No tienes permiso para restaurar este mensaje.');
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
            return redirect()->route('admin.messages.index')->with('success', 'Mensaje marcado como no leído.');
        }

        return redirect()->route('admin.messages.index')->with('error', 'No tienes permiso para modificar este mensaje.');
    }
}