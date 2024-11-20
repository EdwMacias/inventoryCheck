<?php

namespace App\Http\Requests\Items\Equipo;

use App\Rules\ComponentesEquipoDTO;
use Illuminate\Foundation\Http\FormRequest;

class RepuestosEquipoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return !!auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            '*' => 'prohibited',
            'componentes' => 'array|nullable',
            'componentes.*' => ['required', new ComponentesEquipoDTO()]
        ];
    }
}
