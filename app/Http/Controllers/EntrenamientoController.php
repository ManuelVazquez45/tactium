<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEntrenamientoRequest;
use App\Http\Requests\UpdateEntrenamientoRequest;
use App\Models\Entrenamiento;
use App\Models\Equipo;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EntrenamientoController extends Controller
{

    public function listar(Equipo $equipo): View
    {
        $this->authorize('view', $equipo);
        $entrenamientos = $equipo->entrenamientos()->orderBy('fecha', 'desc')->get();
        return view('entrenamientos.index', compact('equipo', 'entrenamientos'));
    }

    public function crear(Equipo $equipo): View
    {
        $this->authorize('update', $equipo);
        return view('entrenamientos.create', compact('equipo'));
    }

    public function guardar(Equipo $equipo, StoreEntrenamientoRequest $request): RedirectResponse
    {
        $this->authorize('update', $equipo);

        $equipo->entrenamientos()->create($request->validated());

        return redirect()->route('entrenamientos.listar', $equipo)
            ->with('success', 'Entrenamiento creado exitosamente.');
    }

    public function ver(Equipo $equipo, Entrenamiento $entrenamiento): View
    {
        $this->authorize('view', $equipo);
        if ($entrenamiento->equipo_id !== $equipo->id) { abort(403); }

        return view('entrenamientos.show', compact('equipo', 'entrenamiento'));
    }

    public function editar(Equipo $equipo, Entrenamiento $entrenamiento): View
    {
        $this->authorize('update', $equipo);
        if ($entrenamiento->equipo_id !== $equipo->id) { abort(403); }

        return view('entrenamientos.edit', compact('equipo', 'entrenamiento'));
    }

    public function actualizar(Equipo $equipo, Entrenamiento $entrenamiento, UpdateEntrenamientoRequest $request): RedirectResponse
    {
        $this->authorize('update', $equipo);
        if ($entrenamiento->equipo_id !== $equipo->id) { abort(403); }

        $entrenamiento->update($request->validated());

        return redirect()->route('entrenamientos.listar', $equipo)
            ->with('success', 'Entrenamiento actualizado exitosamente.');
    }

    public function eliminar(Equipo $equipo, Entrenamiento $entrenamiento): RedirectResponse
    {
        $this->authorize('delete', $equipo);
        if ($entrenamiento->equipo_id !== $equipo->id) { abort(403); }

        $entrenamiento->delete();

        return redirect()->route('entrenamientos.listar', $equipo)
            ->with('success', 'Entrenamiento eliminado exitosamente.');
    }
}

