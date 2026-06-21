<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'jugador_id' => 'required|exists:jugadores,id',
            'concepto' => 'required|string|max:255',
            'importe' => 'required|numeric|min:0',
            'fecha_pago' => 'nullable|date',
            'estado' => 'required|in:pagado,pendiente,sin_pagar',
        ];
    }
}
