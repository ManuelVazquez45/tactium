<?php

namespace App\Http\Controllers;

use App\Models\Entrenamiento;
use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class EntrenamientoController extends Controller
{

    public function index(Equipo $equipo): View
    {
        $this->authorize('view', $equipo);
        $entrenamientos = $equipo->entrenamientos()->orderBy('fecha', 'desc')->get();
        return view('entrenamientos.index', compact('equipo', 'entrenamientos'));
    }

    public function create(Equipo $equipo): View
    {
        $this->authorize('update', $equipo);
        return view('entrenamientos.create', compact('equipo'));
    }

    public function store(Equipo $equipo, Request $request): RedirectResponse
    {
        $this->authorize('update', $equipo);

        $validated = $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'nullable|date_format:H:i',
            'hora_fin' => 'nullable|date_format:H:i',
            'tipo' => 'required|string|in:entrenamiento,partido,amistoso',
            'lugar' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'notas' => 'nullable|string',
            'duracion_minutos' => 'nullable|integer|min:1',
        ]);

        $equipo->entrenamientos()->create($validated);

        return redirect()->route('entrenamientos.index', $equipo)
            ->with('success', 'Entrenamiento creado exitosamente.');
    }

    public function show(Equipo $equipo, Entrenamiento $entrenamiento): View
    {
        $this->authorize('view', $equipo);
        if ($entrenamiento->equipo_id !== $equipo->id) { abort(403); }

        return view('entrenamientos.show', compact('equipo', 'entrenamiento'));
    }

    public function edit(Equipo $equipo, Entrenamiento $entrenamiento): View
    {
        $this->authorize('update', $equipo);
        if ($entrenamiento->equipo_id !== $equipo->id) { abort(403); }

        return view('entrenamientos.edit', compact('equipo', 'entrenamiento'));
    }

    public function update(Equipo $equipo, Entrenamiento $entrenamiento, Request $request): RedirectResponse
    {
        $this->authorize('update', $equipo);
        if ($entrenamiento->equipo_id !== $equipo->id) { abort(403); }

        $validated = $request->validate([
            'fecha' => 'required|date',
            'hora_inicio' => 'nullable|date_format:H:i',
            'hora_fin' => 'nullable|date_format:H:i',
            'tipo' => 'required|string|in:entrenamiento,partido,amistoso',
            'lugar' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'notas' => 'nullable|string',
            'duracion_minutos' => 'nullable|integer|min:1',
        ]);

        $entrenamiento->update($validated);

        return redirect()->route('entrenamientos.index', $equipo)
            ->with('success', 'Entrenamiento actualizado exitosamente.');
    }

    public function destroy(Equipo $equipo, Entrenamiento $entrenamiento): RedirectResponse
    {
        $this->authorize('delete', $equipo);
        if ($entrenamiento->equipo_id !== $equipo->id) { abort(403); }

        $entrenamiento->delete();

        return redirect()->route('entrenamientos.index', $equipo)
            ->with('success', 'Entrenamiento eliminado exitosamente.');
    }
}
