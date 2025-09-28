<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MessageFormRequest;
use App\Models\Message;
use App\Models\User;
use App\Services\MessageService;
use App\Traits\PaginationTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    use PaginationTrait;

    protected $messageService;

    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    public function index(Request $request)
    {
        $query = Message::with('recipient')
            ->where(function($q) {
                $q->where('recipient_id', Auth::id())
                  ->orWhereNull('recipient_id') // Incluir mensajes del sitio público
                  ->orWhere('sender_email', Auth::user()->email); // Incluir mensajes enviados por el usuario
            })
            ->whereIn('status', ['unread', 'read']); // Solo mostrar mensajes no eliminados

        // Apply status filter specifically for inbox
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $messages = $this->paginateWithSearchAndFilters(
            $query,
            ['subject', 'content', 'sender_name'], // searchable fields
            ['status'], // filterable fields
            $request,
            'created_at',
            'desc'
        );

        $unreadMessagesCount = Message::where('recipient_id', Auth::id())->unread()->count();

        return view('admin.messages.inbox', compact('messages', 'unreadMessagesCount'));
    }

    public function archived(Request $request)
    {
        $query = Message::with('recipient')
            ->where(function($q) {
                $q->where('recipient_id', Auth::id())
                  ->orWhereNull('recipient_id') // Incluir mensajes del sitio público
                  ->orWhere('sender_email', Auth::user()->email); // Incluir mensajes enviados por el usuario
            })
            ->archived();

        $messages = $this->paginateWithSearchAndFilters(
            $query,
            ['subject', 'content', 'sender_name'], // searchable fields
            [], // filterable fields
            $request,
            'archived_at',
            'desc'
        );

        $unreadMessagesCount = Message::where('recipient_id', Auth::id())->unread()->count();

        return view('admin.messages.archived', compact('messages', 'unreadMessagesCount'));
    }

    public function deleted(Request $request)
    {
        $query = Message::with('recipient')
            ->where(function($q) {
                $q->where('recipient_id', Auth::id())
                  ->orWhereNull('recipient_id') // Incluir mensajes del sitio público
                  ->orWhere('sender_email', Auth::user()->email); // Incluir mensajes enviados por el usuario
            })
            ->onlyTrashed();

        $messages = $this->paginateWithSearchAndFilters(
            $query,
            ['subject', 'content', 'sender_name'], // searchable fields
            [], // filterable fields
            $request,
            'deleted_at',
            'desc'
        );

        $unreadMessagesCount = Message::where('recipient_id', Auth::id())->unread()->count();

        return view('admin.messages.deleted', compact('messages', 'unreadMessagesCount'));
    }
    
    public function starred(Request $request)
    {
        $query = Message::with('recipient')
            ->where(function($q) {
                $q->where('recipient_id', Auth::id())
                  ->orWhereNull('recipient_id') // Incluir mensajes del sitio público
                  ->orWhere('sender_email', Auth::user()->email); // Incluir mensajes enviados por el usuario
            })
            ->where('is_starred', true) // Solo mostrar mensajes destacados
            ->whereIn('status', ['unread', 'read']); // Solo mostrar mensajes no eliminados

        $messages = $this->paginateWithSearchAndFilters(
            $query,
            ['subject', 'content', 'sender_name'], // searchable fields
            [], // filterable fields
            $request,
            'created_at',
            'desc'
        );

        $unreadMessagesCount = Message::where('recipient_id', Auth::id())->unread()->count();

        return view('admin.messages.starred', compact('messages', 'unreadMessagesCount'));
    }
    
    public function sent(Request $request)
    {
        $query = Message::with('recipient')
            ->where('sender_email', Auth::user()->email) // Solo mostrar mensajes enviados por el usuario
            ->whereIn('status', ['unread', 'read']); // Solo mostrar mensajes no eliminados

        $messages = $this->paginateWithSearchAndFilters(
            $query,
            ['subject', 'content', 'recipient_name'], // searchable fields
            [], // filterable fields
            $request,
            'created_at',
            'desc'
        );

        $unreadMessagesCount = Message::where('recipient_id', Auth::id())->unread()->count();

        return view('admin.messages.sent', compact('messages', 'unreadMessagesCount'));
    }

    public function show(Message $message)
    {
        // Verificar que el mensaje sea para el usuario actual, del sitio público, o enviado por el usuario
        if ($message->recipient_id !== Auth::id() && $message->recipient_id !== null && $message->sender_email !== Auth::user()->email) {
            return redirect()->route('admin.messages.index')->with('error', 'No tienes permiso para ver este mensaje.');
        }

        // Marcar el mensaje como leído si es para el usuario actual
        if ($message->isUnread() && $message->recipient_id === Auth::id()) {
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

    public function store(MessageFormRequest $request)
    {
        $this->messageService->sendMessage($request->validated());

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
            $this->messageService->restoreMessage($message->id);
            return redirect()->back()->with('success', 'Mensaje restaurado exitosamente.');
        }

        return redirect()->back()->with('error', 'No tienes permiso para restaurar este mensaje.');
    }

    public function archive(Message $message)
    {
        // Solo permitir archivar mensajes que sean del usuario actual
        if ($message->recipient_id === Auth::id()) {
            $this->messageService->archiveMessage($message->id);
            return redirect()->route('admin.messages.index')->with('success', 'Mensaje archivado exitosamente.');
        }

        return redirect()->route('admin.messages.index')->with('error', 'No tienes permiso para archivar este mensaje.');
    }

    public function unread(Message $message)
    {
        // Solo permitir marcar como no leído mensajes que sean del usuario actual
        if ($message->recipient_id === Auth::id()) {
            $this->messageService->markAsUnread($message->id);
            return redirect()->route('admin.messages.index')->with('success', 'Mensaje marcado como no leído.');
        }

        return redirect()->route('admin.messages.index')->with('error', 'No tienes permiso para modificar este mensaje.');
    }
}