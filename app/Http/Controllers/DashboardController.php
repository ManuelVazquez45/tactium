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

        if ($user->role === 'entrenador') {
            return redirect()->route('entrenador.dashboard');
        }

        if ($user->role === 'jugador') {
            $equipos = $user->equipos()->where('team_user.estado', 'aprobado')->get();
            return view('dashboard', compact('equipos'));
        }

        $equiposCount = Equipo::where('status', 'approved')->count();
        $pendientesCount = Equipo::where('status', 'pending')->count();
        $rechazadosCount = Equipo::where('status', 'rejected')->count();
        $entrenadoresCount = User::where('role', 'entrenador')->count();

        $equiposSolicitados = Equipo::with('coach')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('dashboard', compact(
            'equiposCount',
            'pendientesCount',
            'rechazadosCount',
            'entrenadoresCount',
            'equiposSolicitados'
        ));
    }
}
