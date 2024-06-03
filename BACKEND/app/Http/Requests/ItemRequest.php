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
            'name' => 'required|string|max:50',
            'serial_number' => 'required|string|max:100',
            'description' => 'required|string',
            'resource' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
