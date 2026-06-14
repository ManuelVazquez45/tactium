<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pago extends Model
{
    protected $fillable = [
        'jugador_id',
        'equipo_id',
        'concepto',
        'importe',
        'fecha_pago',
        'estado',
    ];

    protected $casts = [
        'fecha_pago' => 'date',
        'importe'    => 'decimal:2',
    ];

    public function jugador(): BelongsTo
    {
        return $this->belongsTo(Jugador::class);
    }

    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }
}
