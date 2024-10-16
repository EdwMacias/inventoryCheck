<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'serie_lote' => 'required|string|max:100',
            'valor_adquisicion' => 'required|numeric',
            'unidadId' => 'required|integer|exists:unidades,unidad_id',
            'cantidad' => 'required|numeric|min:1',
            'resource' => 'required|array',
            'resource.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    /**
     * Get custom error messages for validation.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            '*' => 'El campo :attribute no es permitido',
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El campo nombre no puede tener más de 50 caracteres.',
            'serie_lote.required' => 'El campo serie/lote es obligatorio.',
            'serie_lote.string' => 'El campo serie/lote debe ser una cadena de texto.',
            'serie_lote.max' => 'El campo serie/lote no puede tener más de 100 caracteres.',
            'valor_adquisicion.required' => 'El campo valor de adquisición es obligatorio.',
            'valor_adquisicion.numeric' => 'El campo valor de adquisición debe ser un número.',
            'unidadId.required' => 'El campo unidad es obligatorio.',
            'unidadId.integer' => 'El campo unidad debe ser un número entero.',
            'unidadId.exists' => 'La unidad seleccionada no existe.',
            'cantidad.required' => 'El campo cantidad es obligatorio.',
            'cantidad.numeric' => 'El campo cantidad debe ser un número.',
            'cantidad.min' => 'El campo cantidad debe ser al menos 1.',
            'resource.required' => 'El campo recursos es obligatorio.',
            'resource.array' => 'El campo recursos debe ser un arreglo.',
            'resource.*.required' => 'Cada archivo de recurso es obligatorio.',
            'resource.*.image' => 'Cada recurso debe ser una imagen.',
            'resource.*.mimes' => 'Cada recurso debe ser un archivo de tipo: jpeg, png, jpg.',
            'resource.*.max' => 'Cada recurso no debe superar los 2048 KB.',
        ];
    }
}
