<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Entrenamiento extends Model
{
    protected $fillable = [
        'equipo_id',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'tipo',
        'lugar',
        'descripcion',
        'notas',
        'duracion_minutos',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora_inicio' => 'string',
        'hora_fin' => 'string',
    ];

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }
}
