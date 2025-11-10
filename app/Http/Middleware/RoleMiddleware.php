<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Maneja una solicitud entrante.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Si el usuario autenticado tiene el rol correcto
        if (Auth::user()->rol->nombre === $role || Auth::user()->id_rol == 1) {
            return $next($request);
        }

        // Si no tiene permiso, mostramos error 403
        abort(403, 'Acceso denegado – No tienes permiso para acceder a esta sección.');
    }
}
