<?php

namespace App\Http\Requests\Items\Observation;

use Illuminate\Foundation\Http\FormRequest;

class ItemObservationUpdateRequest extends FormRequest
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
            'types_observation_id' => 'required|string',
        ];
    }
}
