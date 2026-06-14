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
        return $user->role === 'admin' || $user->role === 'entrenador';
    }

    /**
     * Determine whether the user can view the model.
     */
    // app/Policies/EquipoPolicy.php
    public function view(User $user, Equipo $equipo)
    {
        return true; // O tu lógica de permisos. Sin este archivo, el controlador fallará.
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin' || $user->role === 'entrenador';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Equipo $equipo): bool
    {
        return $user->role === 'admin' || $user->id === $equipo->coach_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Equipo $equipo): bool
    {
        return $user->role === 'admin' || $user->id === $equipo->coach_id;
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
