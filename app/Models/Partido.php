<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partido extends Model
{
    protected $fillable = [
        'equipo_id',
        'fecha',
        'hora',
        'rival',
        'lugar',
        'tipo_ubicacion',
        'goles_favor',
        'goles_contra',
        'estado',
        'descripcion',
        'notas',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }
}
