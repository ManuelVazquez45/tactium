<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Equipo;
use App\Models\User;

class EquipoPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Todos los roles registrados pueden listar equipos
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    // app/Policies/EquipoPolicy.php
    public function view(User $user, Equipo $equipo): bool
    {
        // Todos pueden ver el detalle
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo administradores y entrenadores pueden crear
        return in_array($user->role, ['admin', 'entrenador']);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Equipo $equipo): bool
    {
        // Administrador tiene control total. El Entrenador solo si es el dueño (coach_id).
        return $user->role === 'admin' || $user->id === (int)$equipo->coach_id;
    }

    public function delete(User $user, Equipo $equipo): bool
    {
        // Administrador tiene control total. El Entrenador solo si es el dueño (coach_id).
        return $user->role === 'admin' || $user->id === (int)$equipo->coach_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Equipo $equipo): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Equipo $equipo): bool
    {
        return $user->role === 'admin';
    }
}
