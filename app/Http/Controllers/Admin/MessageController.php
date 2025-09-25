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
            ->where('recipient_id', Auth::id())
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

        return view('admin.messages.index', compact('messages'));
    }

    public function archived(Request $request)
    {
        $query = Message::with('recipient')
            ->where('recipient_id', Auth::id())
            ->archived();

        $messages = $this->paginateWithSearchAndFilters(
            $query,
            ['subject', 'content', 'sender_name'], // searchable fields
            [], // filterable fields
            $request,
            'archived_at',
            'desc'
        );

        return view('admin.messages.archived', compact('messages'));
    }

    public function deleted(Request $request)
    {
        $query = Message::with('recipient')
            ->where('recipient_id', Auth::id())
            ->onlyTrashed();

        $messages = $this->paginateWithSearchAndFilters(
            $query,
            ['subject', 'content', 'sender_name'], // searchable fields
            [], // filterable fields
            $request,
            'deleted_at',
            'desc'
        );

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