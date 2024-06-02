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
            "*" => "prohibited",
            // "name",
            // "serial_number",
            // "description",
            // "category_id",
            "resource" => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // "statu_id"
        ];
    }
}
