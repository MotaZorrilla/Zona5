<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseSession;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        // Obtener todos los cursos asíncronos
        $asynchronousCourses = Course::where('type', 'asynchronous')
            ->orderBy('created_at', 'desc')
            ->get();

        // Obtener todas las sesiones próximas de cursos síncronos
        $upcomingSessions = CourseSession::where('status', 'upcoming')
            ->where('start_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->limit(6) // Limitar a 6 próximas sesiones
            ->get();

        // Obtener sesiones en vivo
        $liveSessions = CourseSession::where('status', 'live')
            ->get();

        return view('public.school', compact(
            'asynchronousCourses', 
            'upcomingSessions', 
            'liveSessions'
        ));
    }
}