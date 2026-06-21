<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartidoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fecha' => 'required|date',
            'hora' => 'nullable|date_format:H:i',
            'rival' => 'required|string|max:255',
            'lugar' => 'nullable|string|max:255',
            'tipo_ubicacion' => 'required|in:local,visitante',
            'goles_favor' => 'nullable|integer|min:0',
            'goles_contra' => 'nullable|integer|min:0',
            'estado' => 'required|in:programado,jugado,cancelado',
            'descripcion' => 'nullable|string',
            'notas' => 'nullable|string',
        ];
    }
}
