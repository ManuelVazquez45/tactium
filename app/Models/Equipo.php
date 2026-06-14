<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Equipo extends Model
{
    // Definición de constantes para evitar errores de cadena en la lógica
    public const ESTADO_PENDIENTE = 'pendiente';
    public const ESTADO_APROBADO = 'aprobado';
    public const ESTADO_RECHAZADO = 'rechazado';

protected $fillable = [
    'nombre',
    'descripcion',
    'coach_id',
    'estado',
    'cuota',
];

    /**
     * Definición de tipos para los atributos (Casting).
     * Esto ayuda a Laravel a manejar los datos correctamente.
     */
    protected function casts(): array
    {
        return [
            'coach_id' => 'integer',
        ];
    }

    // Relaciones (Correctas según tu estructura actual)
    public function coach(): BelongsTo
    {
        return $this->belongsTo(User::class, 'coach_id');
    }

    public function jugadores(): HasMany
    {
        return $this->hasMany(Jugador::class);
    }

    public function entrenamientos(): HasMany
    {
        return $this->hasMany(Entrenamiento::class);
    }

    public function partidos(): HasMany
    {
        return $this->hasMany(Partido::class);
    }

    public function pagos(): HasMany
    {
        return $this->hasMany(Pago::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'team_user')
            ->withPivot('estado')
            ->withTimestamps();
    }
}
