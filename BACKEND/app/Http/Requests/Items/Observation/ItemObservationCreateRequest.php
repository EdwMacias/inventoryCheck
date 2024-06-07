<?php

namespace App\Http\Requests\Items\Observation;

use Illuminate\Foundation\Http\FormRequest;

class ItemObservationCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            'observation' => 'required|string',
            'item_id' => 'required|string',
            'user_id' => 'required|string',
            'types_observation_id' => 'required|string',
            'resource' => 'required',
            'resource.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    public function messages(): array
    {
        return [
            'prohibited' => 'El campo :attribute no es permitido.',
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser una cadena de caracteres.',
            'image' => 'El campo :attribute debe ser una imagen.',
            'mimes' => 'El campo :attribute debe ser una imagen con formato JPEG, PNG o JPG.',
            'max' => 'El campo :attribute no debe superar los :max kilobytes.'
        ];
    }
}
