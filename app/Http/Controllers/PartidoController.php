<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePartidoRequest;
use App\Http\Requests\UpdatePartidoRequest;
use App\Models\Equipo;
use App\Models\Partido;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PartidoController extends Controller
{
    public function listar(Equipo $equipo): View
    {
        $this->authorize('view', $equipo);
        $partidos = $equipo->partidos()->orderBy('fecha', 'desc')->get();
        return view('partidos.index', compact('equipo', 'partidos'));
    }

    public function crear(Equipo $equipo): View
    {
        $this->authorize('update', $equipo);
        return view('partidos.create', compact('equipo'));
    }

    public function guardar(Equipo $equipo, StorePartidoRequest $request): RedirectResponse
    {
        $this->authorize('update', $equipo);

        $equipo->partidos()->create($request->validated());

        return redirect()->route('partidos.listar', $equipo)
            ->with('success', 'Partido creado correctamente.');
    }

    public function ver(Equipo $equipo, Partido $partido): View
    {
        $this->authorize('view', $equipo);
        if ($partido->equipo_id !== $equipo->id) { abort(403); }
        return view('partidos.show', compact('equipo', 'partido'));
    }

    public function editar(Equipo $equipo, Partido $partido): View
    {
        $this->authorize('update', $equipo);
        if ($partido->equipo_id !== $equipo->id) { abort(403); }
        return view('partidos.edit', compact('equipo', 'partido'));
    }

    public function actualizar(Equipo $equipo, Partido $partido, UpdatePartidoRequest $request): RedirectResponse
    {
        $this->authorize('update', $equipo);
        if ($partido->equipo_id !== $equipo->id) { abort(403); }

        $partido->update($request->validated());

        return redirect()->route('partidos.listar', $equipo)
            ->with('success', 'Partido actualizado correctamente.');
    }

    public function eliminar(Equipo $equipo, Partido $partido): RedirectResponse
    {
        $this->authorize('delete', $equipo);
        if ($partido->equipo_id !== $equipo->id) { abort(403); }

        $partido->delete();

        return redirect()->route('partidos.listar', $equipo)
            ->with('success', 'Partido eliminado correctamente.');
    }
}

