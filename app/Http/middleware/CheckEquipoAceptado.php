<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEquipoAceptado
{
    public function handle(Request $request, Closure $next): Response
    {
       $user = $request->user();

        // 1. Verificación de Autenticación
        if (!$user) {
            return redirect()->route('login');
        }

        // 2. Verificación de Rol (Seguridad Estricta)
        // Solo Admin o Entrenador tienen acceso a la Zona de Alta Seguridad
        if (!in_array($user->role, ['admin', 'entrenador'])) {
            abort(403, 'Acceso denegado: Se requiere rol de entrenador o administrador.');
        }

        // 3. Verificación de Estado del Equipo
        // Asegúrate de que este método exista y funcione en tu Modelo User
        if (!$user->equipoAceptado()) {
            return redirect()->route('entrenador.dashboard')
                ->with('error', 'Acceso denegado. Tu equipo aún no ha sido aprobado por el administrador.');
        }

        return $next($request);
    }
}
