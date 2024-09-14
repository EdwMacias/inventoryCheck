<?php

namespace App\Http\Requests\Items\Observation\Item\Basico;

use Illuminate\Foundation\Http\FormRequest;

class ObservacionItemBasicoRequest extends FormRequest
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
            //
            '*' => 'prohibited',
            'itemId' => 'required|string',
            'fecha' => 'required|date',
            'userId' => 'nullable|string',
            'observacion' => 'required|string',
            'tipoObservacionId' => 'required|string',
            'resources' => 'nullable|array',
            'resources.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }
}
