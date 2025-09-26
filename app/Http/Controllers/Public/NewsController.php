<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Event;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        // Obtener noticias publicadas ordenadas por fecha de publicación
        $news = News::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        // También obtener eventos públicos para mostrarlos en la misma página
        $events = Event::where('is_public', true)
            ->orderBy('start_time', 'asc')
            ->limit(6)
            ->get();

        return view('public.news', compact('news', 'events'));
    }
}