<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JugadorController extends Controller
{
    public function create(Equipo $equipo): View
    {
        $this->authorize('update', $equipo);
        return view('jugadores.create', compact('equipo'));
    }

    public function store(Equipo $equipo): RedirectResponse
    {
        $this->authorize('update', $equipo);

        $validated = request()->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:jugadores',
            'numero_camiseta' => 'nullable|string|max:3',
            'posicion' => 'nullable|string|max:50',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $equipo->jugadores()->create($validated);

        return redirect()->route('entrenador.dashboard', $equipo)
            ->with('success', 'Jugador agregado correctamente.');
    }

    public function edit(Equipo $equipo, Jugador $jugador): View
    {
        $this->authorize('update', $equipo);

        if ($jugador->equipo_id !== $equipo->id) {
            abort(403);
        }

        return view('jugadores.edit', compact('equipo', 'jugador'));
    }

    public function update(Equipo $equipo, Jugador $jugador): RedirectResponse
    {
        $this->authorize('update', $equipo);

        if ($jugador->equipo_id !== $equipo->id) {
            abort(403);
        }

        $validated = request()->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:jugadores,email,' . $jugador->id,
            'numero_camiseta' => 'nullable|string|max:3',
            'posicion' => 'nullable|string|max:50',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $jugador->update($validated);

        return redirect()->route('entrenador.dashboard', $equipo)
            ->with('success', 'Jugador actualizado correctamente.');
    }

    public function destroy(Equipo $equipo, Jugador $jugador): RedirectResponse
    {
        $this->authorize('delete', $equipo);

        if ($jugador->equipo_id !== $equipo->id) {
            abort(403);
        }

        $jugador->delete();

        return redirect()->route('entrenador.dashboard', $equipo)
            ->with('success', 'Jugador eliminado correctamente.');
    }
}
