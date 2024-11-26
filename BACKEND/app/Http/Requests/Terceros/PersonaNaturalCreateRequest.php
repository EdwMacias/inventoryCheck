<?php

namespace App\Http\Requests\Terceros;

use Illuminate\Foundation\Http\FormRequest;

class PersonaNaturalCreateRequest extends FormRequest
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
            '*' => 'prohibited',
            'primerNombre' => 'required|string',
            'segundoNombre' => 'nullable|string',
            'primerApellido' => 'required|string',
            'segundoApellido' => 'nullable|string',
            'tipoIdentificacion' => 'required|integer|exists:types_documents,document_type_id',
            'numeroIdentificacion' => 'required|integer',
            'telefono' => 'required|integer',
            'correo' => 'nullable|email',
            'direccion' => 'required|string',
            'departamento' => 'required|string',
            'ciudad' => 'required|string',
            'dv' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'primerNombre.required' => 'El primer nombre es obligatorio.',
            'primerNombre.string' => 'El primer nombre debe ser una cadena de texto.',
            'segundoNombre.string' => 'El segundo nombre debe ser una cadena de texto.',
            'primerApellido.required' => 'El primer apellido es obligatorio.',
            'primerApellido.string' => 'El primer apellido debe ser una cadena de texto.',
            'segundoApellido.string' => 'El segundo apellido debe ser una cadena de texto.',
            'tipoIdentificacion.required' => 'El tipo de identificación es obligatorio.',
            'tipoIdentificacion.integer' => 'El tipo de identificación debe ser un número entero.',
            'tipoIdentificacion.exists' => 'El tipo de identificación no existe en la base de datos.',
            'numeroIdentificacion.required' => 'El número de identificación es obligatorio.',
            'numeroIdentificacion.integer' => 'El número de identificación debe ser un número entero.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.integer' => 'El teléfono debe ser un número entero.',
            'correo.email' => 'El correo electrónico debe tener un formato válido.',
            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.string' => 'La dirección debe ser una cadena de texto.',
            'departamento.required' => 'El departamento es obligatorio.',
            'departamento.string' => 'El departamento debe ser una cadena de texto.',
            'ciudad.required' => 'La ciudad es obligatoria.',
            'ciudad.string' => 'La ciudad debe ser una cadena de texto.',
            'dv.integer' => 'El dígito de verificación debe ser un número entero.',
        ];
    }

}
