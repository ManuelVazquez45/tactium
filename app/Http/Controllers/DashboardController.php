<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $user = auth()->user();

        // 1. Control de Roles (Aceptable, aunque idealmente debe apoyarse en Middleware)
        if ($user->role === 'entrenador') {
            return redirect()->route('entrenador.dashboard');
        }

        // 2. KPIs Generales para el Admin
        $equiposCount = Equipo::where('estado', 'aprobado')->count();
        $pendientesCount = Equipo::where('estado', 'pendiente')->count();
        $rechazadosCount = Equipo::where('estado', 'denegado')->count();
        $entrenadoresCount = User::where('role', 'entrenador')->count();

        // 3. NUEVA CONSULTA: Solicitudes de Equipos (Requisito de la nueva tabla)
        // Usamos Eager Loading con 'with()' para optimizar la carga del usuario relacionado
        $equiposSolicitados = Equipo::with('coach') // IMPORTANTE: Asegúrate de que la relación en tu modelo Equipo se llame 'entrenador' o cámbialo a 'user'/'coach' según lo tengas definido.
            ->where('estado', 'pendiente')
            ->orderBy('created_at', 'asc') // Priorizamos por tiempo de espera (los más antiguos primero)
            ->get();

        // 4. Retorno a la vista actualizando el compact
        return view('dashboard', compact(
            'equiposCount',
            'pendientesCount',
            'rechazadosCount',
            'entrenadoresCount',
            'equiposSolicitados' // Sustituimos 'entrenadores' por la nueva variable
        ));
    }
}
