<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EntrenadorDashboardController extends Controller
{
   public function index(): View
{
    $equipos = Equipo::where('coach_id', auth()->id())->get();

    $equiposAprobados      = $equipos->filter(fn($e) => $e->estado === 'aprobado');
    $solicitudesPendientes = $equipos->filter(fn($e) => $e->estado === 'pendiente');
    $equiposRechazados     = $equipos->filter(fn($e) => $e->estado === 'denegado');

    $equipoSeleccionado = null;
    if (request('equipo_id')) {
        $equipoSeleccionado = $equiposAprobados->find(request('equipo_id'));
    }

    return view('entrenador.dashboard', compact('equiposAprobados', 'solicitudesPendientes', 'equiposRechazados', 'equipoSeleccionado'));
}
}
