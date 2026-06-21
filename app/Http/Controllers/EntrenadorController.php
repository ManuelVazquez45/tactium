<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class EntrenadorController extends Controller
{
    public function listar(): View
    {
        $entrenadores = User::where('role', 'entrenador')
            ->withCount('equipos')
            ->paginate(10);
        return view('entrenadores.index', compact('entrenadores'));
    }
}

