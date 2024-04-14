<?php

namespace App\Http\Requests;

use App\Utils\Encriptacion;
use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'document_type_id' => 'required|int',
            'number_document' => 'required|string|max:30',
            'gender_id' => 'required|int',
            'address' => 'required|string|max:100',
            'number_telephone' => 'required|string|max:25'
        ];
    }
}
