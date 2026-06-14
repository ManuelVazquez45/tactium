<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Partido;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PartidoController extends Controller
{
    public function index(Equipo $equipo): View
    {
        $this->authorize('view', $equipo);
        $partidos = $equipo->partidos()->orderBy('fecha', 'desc')->get();
        return view('partidos.index', compact('equipo', 'partidos'));
    }

    public function create(Equipo $equipo): View
    {
        $this->authorize('update', $equipo);
        return view('partidos.create', compact('equipo'));
    }

    public function store(Equipo $equipo, Request $request): RedirectResponse
    {
        $this->authorize('update', $equipo);

        $validated = $request->validate([
            'fecha'          => 'required|date',
            'hora'           => 'nullable|date_format:H:i',
            'rival'          => 'required|string|max:255',
            'lugar'          => 'nullable|string|max:255',
            'tipo_ubicacion' => 'required|in:local,visitante',
            'goles_favor'    => 'nullable|integer|min:0',
            'goles_contra'   => 'nullable|integer|min:0',
            'estado'         => 'required|in:programado,jugado,cancelado',
            'descripcion'    => 'nullable|string',
            'notas'          => 'nullable|string',
        ]);

        $equipo->partidos()->create($validated);

        return redirect()->route('partidos.index', $equipo)
            ->with('success', 'Partido creado correctamente.');
    }

    public function show(Equipo $equipo, Partido $partido): View
    {
        $this->authorize('view', $equipo);
        if ($partido->equipo_id !== $equipo->id) { abort(403); }
        return view('partidos.show', compact('equipo', 'partido'));
    }

    public function edit(Equipo $equipo, Partido $partido): View
    {
        $this->authorize('update', $equipo);
        if ($partido->equipo_id !== $equipo->id) { abort(403); }
        return view('partidos.edit', compact('equipo', 'partido'));
    }

    public function update(Equipo $equipo, Partido $partido, Request $request): RedirectResponse
    {
        $this->authorize('update', $equipo);
        if ($partido->equipo_id !== $equipo->id) { abort(403); }

        $validated = $request->validate([
            'fecha'          => 'required|date',
            'hora'           => 'nullable|date_format:H:i',
            'rival'          => 'required|string|max:255',
            'lugar'          => 'nullable|string|max:255',
            'tipo_ubicacion' => 'required|in:local,visitante',
            'goles_favor'    => 'nullable|integer|min:0',
            'goles_contra'   => 'nullable|integer|min:0',
            'estado'         => 'required|in:programado,jugado,cancelado',
            'descripcion'    => 'nullable|string',
            'notas'          => 'nullable|string',
        ]);

        $partido->update($validated);

        return redirect()->route('partidos.index', $equipo)
            ->with('success', 'Partido actualizado correctamente.');
    }

    public function destroy(Equipo $equipo, Partido $partido): RedirectResponse
    {
        $this->authorize('delete', $equipo);
        if ($partido->equipo_id !== $equipo->id) { abort(403); }

        $partido->delete();

        return redirect()->route('partidos.index', $equipo)
            ->with('success', 'Partido eliminado correctamente.');
    }
}
