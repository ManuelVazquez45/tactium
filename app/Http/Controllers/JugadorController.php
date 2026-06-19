<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'required|email|unique:jugadores|unique:users',
            'numero_camiseta' => 'nullable|string|max:3',
            'posicion' => 'nullable|string|max:50',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $equipo->jugadores()->create($validated);

        $password = str()->random(12);
        $user = User::create([
            'name' => $validated['nombre'] . ' ' . $validated['apellido'],
            'email' => $validated['email'],
            'password' => Hash::make($password),
            'role' => 'jugador',
            'email_verified_at' => now(),
        ]);

        $equipo->users()->attach($user, ['estado' => 'aprobado']);

        return redirect()->route('entrenador.dashboard')
            ->with('success', "Jugador creado. Email: {$validated['email']}, Contraseña: {$password}");
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
