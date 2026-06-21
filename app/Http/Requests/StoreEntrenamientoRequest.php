<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntrenamientoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fecha' => 'required|date',
            'hora_inicio' => 'nullable|date_format:H:i',
            'hora_fin' => 'nullable|date_format:H:i',
            'tipo' => 'required|string|in:entrenamiento,partido,amistoso',
            'lugar' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'notas' => 'nullable|string',
            'duracion_minutos' => 'nullable|integer|min:1',
        ];
    }
}
