<?php

namespace App\Http\Requests\Pqrs;

use Illuminate\Foundation\Http\FormRequest;

class PqrsRequestCreate extends FormRequest
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
            'opcion' => 'nullable|numeric',
            'name' => 'nullable|string',
            'descriptionPQRS' => 'required|string',
        ];
    }
}
