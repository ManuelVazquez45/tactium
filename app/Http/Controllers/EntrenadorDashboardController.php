<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EntrenadorDashboardController extends Controller
{
   public function index(): View
{
    $equipos = auth()->user()->equipos;

    $equiposAprobados      = $equipos->filter(fn($e) => $e->pivot->estado === 'aprobado');
    $solicitudesPendientes = $equipos->filter(fn($e) => $e->pivot->estado === 'pendiente');
    $equiposRechazados     = $equipos->filter(fn($e) => $e->pivot->estado === 'denegado');

    return view('entrenador.dashboard', compact('equiposAprobados', 'solicitudesPendientes', 'equiposRechazados'));
}
}
