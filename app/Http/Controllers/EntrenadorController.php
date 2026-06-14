<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class EntrenadorController extends Controller
{
    /**
     * Obtener todos los entrenadores registrados
     */
    public function index(): View
    {
        $entrenadores = User::where('role', 'entrenador')
            ->withCount('equipos')
            ->paginate(10);
        return view('entrenadores.index', compact('entrenadores'));
    }

    /**
     * Obtener entrenadores para el dashboard
     */
    public static function getActivos(int $limit = 5)
    {
        return User::where('role', 'entrenador')
            ->withCount('equipos')
            ->limit($limit)
            ->get();
    }

    /**
     * Obtener total de entrenadores
     */
    public static function getTotalCount(): int
    {
        return User::where('role', 'entrenador')->count();
    }
}
