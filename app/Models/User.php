<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación con equipos.
     * CORRECCIÓN: Se cambió 'status' por 'estado' en el withPivot.
     */
    public function equipos(): BelongsToMany
    {
        return $this->belongsToMany(Equipo::class, 'team_user')
            ->withPivot('estado')
            ->withTimestamps();
    }

    /**
     * Verificación de equipo aceptado.
     * CORRECCIÓN: Se ha cambiado la lógica para que funcione con el nuevo campo 'estado'.
     * Devuelve true si el usuario tiene al menos un equipo con estado 'aprobado'.
     */
    public function equipoAceptado()
    {
        if ($this->role === 'entrenador') {
            return Equipo::where('coach_id', $this->id)->where('estado', 'aprobado')->exists();
        }
        return $this->equipos()->wherePivot('estado', 'aprobado')->exists();
    }

    public function primerEquipoAceptado()
    {
        if ($this->role === 'entrenador') {
            return Equipo::where('coach_id', $this->id)->where('estado', 'aprobado')->first();
        }
        return $this->equipos()->wherePivot('estado', 'aprobado')->first();
    }
}
