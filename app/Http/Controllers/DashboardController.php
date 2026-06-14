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

        // Si es entrenador, redireccionar a su panel
        if ($user->role === 'entrenador') {
            return redirect()->route('entrenador.dashboard');
        }

        // Dashboard para ADMIN
        $equiposCount = Equipo::where('estado', 'aprobado')->count();
        $pendientesCount = Equipo::where('estado', 'pendiente')->count();
        $rechazadosCount = Equipo::where('estado', 'denegado')->count();
        $entrenadoresCount = User::where('role', 'entrenador')->count();
        $entrenadores = User::where('role', 'entrenador')
            ->withCount('equipos')
            ->limit(5)
            ->get();

        return view('dashboard', compact('equiposCount', 'pendientesCount', 'rechazadosCount', 'entrenadoresCount', 'entrenadores'));
    }
}
