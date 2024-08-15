<?php

namespace App\Http\Requests\Items\Observation;

use Illuminate\Foundation\Http\FormRequest;

class ObservacionEquipoResquestCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user() ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // '*' => 'prohibited',
            'equipo_id' => 'required|string',
            'fecha' => 'required|date',
            'asunto' => 'required|string',
            'actividad' => 'required|string',
            'estado' => 'required|string',
            'responsable' => 'required|string',
            'firma_responsable' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'resource' => 'required|array',
            'resource.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'proxima_actividad' => 'required|date',
        ];
    }
    public function messages(): array
    {
        return [
            'equipo_id.required' => 'El campo equipo es obligatorio.',
            'fecha.required' => 'El campo fecha es obligatorio.',
            'asunto.required' => 'El campo asunto es obligatorio.',
            'actividad.required' => 'El campo actividad es obligatorio.',
            'estado.required' => 'El campo estado es obligatorio.',
            'responsable.required' => 'El campo responsable es obligatorio.',
            'firma_responsable.required' => 'La firma del responsable es obligatoria.',
            'firma_responsable.image' => 'La firma del responsable debe ser una imagen.',
            'firma_responsable.mimes' => 'La firma del responsable debe ser un archivo de tipo: jpeg, png, jpg.',
            'firma_responsable.max' => 'La firma del responsable no debe ser mayor a 2048 KB.',
            'resource.array' => 'Se requiere una lista de array',
            'resource.required' => 'El campo resource es requerido',
            'resource.*.required' => 'Cada imagen en resources es obligatoria.',
            'resource.*.image' => 'Cada archivo en resources debe ser una imagen.',
            'resource.*.mimes' => 'Cada archivo en resources debe ser un archivo de tipo: jpeg, png, jpg.',
            'resource.*.max' => 'Cada archivo en resources no debe ser mayor a 2048 KB.',
            'proxima_actividad.required' => 'El campo próxima actividad es obligatorio.',
            'proxima_actividad.date' => 'El campo próxima actividad debe ser una fecha válida.',
        ];
    }
}
