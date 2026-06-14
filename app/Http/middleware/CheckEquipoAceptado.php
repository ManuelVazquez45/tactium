<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEquipoAceptado
{
    public function handle(Request $request, Closure $next): Response
    {
        // Validación estricta: usuario autenticado y equipo aceptado
        if (!$request->user() || !$request->user()->equipoAceptado()) {
            return redirect()->route('entrenador.dashboard')
                ->with('error', 'Acceso denegado. Debes aceptar el equipo primero.');
        }

        return $next($request);
    }
}
