<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Lodge;
use App\Models\News;
use App\Models\Position;
use App\Models\ZoneDignitary;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener las últimas 3 noticias publicadas
        $latestNews = News::where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Obtener 3 logias aleatorias
        $featuredLodges = Lodge::inRandomOrder()->limit(3)->get();

        // Obtener las dignidades principales de la zona
        // Primero obtenemos las posiciones importantes (por ejemplo: Presidente, Vicepresidente, Secretario)
        $importantPositions = Position::whereIn('name', ['Presidente', 'Vicepresidente', 'Secretario'])->get();
        
        // Obtener las autoridades reales de la zona
        $zoneDignitaries = ZoneDignitary::whereIn('role', ['Presidente', 'Vicepresidente', 'Secretario'])->get();

        return view('welcome', compact('latestNews', 'featuredLodges', 'importantPositions', 'zoneDignitaries'));
    }
}