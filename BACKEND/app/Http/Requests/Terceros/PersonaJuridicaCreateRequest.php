<?php

namespace App\Http\Requests\Terceros;

use Illuminate\Foundation\Http\FormRequest;

class PersonaJuridicaCreateRequest extends FormRequest
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
            //
            
            'razonSocial' => 'required|string',
            'nit' => 'required|string',
            'tipoEntidad' => 'nullable|string',
            'fechaRegistroCamara' => 'nullable|date',
            'numeroRegistro' => 'nullable|integer',
            'pais' => 'nullable|string',
            'representanteLegal' => 'nullable|string',
            'telefono' => 'required|string',
            'email' => 'required|email',
        ];
    }

    public function messages(): array
    {
        return [
            'razonSocial.required' => 'La razón social es obligatoria.',
            'razonSocial.string' => 'La razón social debe ser un texto válido.',
            'nit.required' => 'El NIT es obligatorio.',
            'nit.string' => 'El NIT debe ser un texto válido.',
            'tipoEntidad.string' => 'El tipo de entidad debe ser un texto válido.',
            'fechaRegistroCamara.date' => 'La fecha de registro en la cámara debe ser una fecha válida.',
            'numeroRegistro.integer' => 'El número de registro debe ser un número entero válido.',
            'pais.string' => 'El país debe ser un texto válido.',
            'representanteLegal.string' => 'El representante legal debe ser un texto válido.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.string' => 'El teléfono debe ser un texto válido.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
        ];
    }

}
