<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Middleware para verificar que el usuario es administrador
 * 
 * Protege las rutas del panel de administración
 */
class AdminMiddleware
{
    /**
     * Verifica que el usuario esté autenticado y sea administrador
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder al panel');
        }

        // Verificar si el usuario tiene rol de administrador
        if (Auth::user()->role !== 'admin') {
            abort(403, 'No tienes permisos de administrador');
        }

        return $next($request);
    }
}