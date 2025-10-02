<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function show(Event $event)
    {
        if (!$event->is_public) {
            abort(404);
        }

        return view('public.event-show', compact('event'));
    }
}