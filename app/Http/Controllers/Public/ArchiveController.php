<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        // Verificar si el usuario está autenticado
        $isAuthenticated = Auth::check();
        
        // Configuración de la página
        $pageSettings = [
            'title' => 'Archivo Histórico',
            'subtitle' => 'Un viaje a través de los documentos que han marcado nuestra historia.',
            'banner_image' => 'https://picsum.photos/seed/archive-hero/1920/1080',
            'restricted' => !$isAuthenticated,
        ];

        // Si no está autenticado, mostrar página con overlay de acceso restringido
        if (!$isAuthenticated) {
            $documents = collect(); // Colección vacía
            $categories = collect();
            $grades = collect();
            
            return view('public.archive', compact('documents', 'categories', 'grades', 'pageSettings'));
        }

        // Si está autenticado, mostrar contenido normal
        // Obtener parámetros de búsqueda y filtros
        $search = $request->get('search');
        $category = $request->get('category');
        $grade = $request->get('grade');

        // Construir la consulta
        $query = Repository::query();

        // Aplicar filtros de búsqueda
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        if ($grade && $grade !== 'Todos') {
            $query->where('grade_level', $grade);
        }

        // Obtener documentos paginados
        $documents = $query->orderBy('created_at', 'desc')->paginate(12);

        // Obtener categorías y grados únicos para los filtros
        $categories = Repository::select('category')->distinct()->whereNotNull('category')->pluck('category')->sort();
        $grades = Repository::select('grade_level')->distinct()->whereNotNull('grade_level')->pluck('grade_level')->sort();

        return view('public.archive', compact('documents', 'categories', 'grades', 'pageSettings'));
    }
}