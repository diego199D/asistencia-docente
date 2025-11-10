<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Manejar una solicitud entrante.
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->id_rol == 1) {
            return $next($request);
        }

        abort(403, 'Acceso denegado — Solo el administrador puede acceder.');
    }
}