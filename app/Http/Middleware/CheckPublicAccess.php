<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPublicAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $permission = null): Response
    {
        // Si se requiere autenticación y el usuario no está autenticado
        if ($permission === 'auth' && !Auth::check()) {
            // Redirigir a la página de inicio de sesión con un mensaje
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta sección.');
        }

        return $next($request);
    }
}