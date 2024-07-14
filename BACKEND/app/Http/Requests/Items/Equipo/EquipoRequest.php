<?php

namespace App\Http\Requests\Items\Equipo;

use Illuminate\Foundation\Http\FormRequest;

class EquipoRequest extends FormRequest
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
            'name' => 'required|string',
            'fabricante' => 'required|string',
            'modelo' => 'required|string',
            'marca' => 'required|string',
            'serie_lote' => 'required|string',
            'activo_fijo' => 'required|string',
            'ubicacion' => 'required|string',
            'ficha_tecnica' => 'required|string',
            'manual' => 'required|string',
            'garantia' => 'required|string',
            'instruc_operacion' => 'required|string',
            'periodicidad_calibracion' => 'required|string',
            'periodicidad_verificacion' => 'required|string',
            'proveedor' => 'required|string',
            'contacto_proveedor' => 'required|string',
            'telefono_proveedor' => 'required|string',
            'email_proveedor' => 'required|string|email',
            'resolucion' => 'nullable|string',
            'clase_exactitud' => 'nullable|string',
            'rango_medicion' => 'nullable|string',
            'intervalo_medicion' => 'nullable|string',
            'error_maximo_permitido' => 'nullable|string',
            'fecha_adquisicion' => 'required|date',
            'valor_adquisicion' => 'nullable|integer',
            'numero_factura' => 'nullable|string',
            'frecuencia_verificacion' => 'required|string',
            'category_id' => 'required|string',
            'procedimiento_verificacion' => 'required|string',
            'frecuencia_calibracion' => 'required|string',
            'fecha_calibracion_actual' => 'nullable|date',
            'fecha_proxima_calibracion' => 'nullable|date',
            'maxima_incertidumbre_calibracion' => 'nullable|string',
            'proveedor_calibracion' => 'nullable|string',
            'contacto_calibracion' => 'nullable|string',
            'email_calibracion' => 'nullable|string|email',
            'telefono_calibracion' => 'nullable|string',
            'cond_electrica' => 'required|bool',
            'cond_mecanica' => 'required|bool',
            'cond_ambientales' => 'required|bool',
            'cond_seguridad' => 'required|bool',
            'cond_transporte' => 'required|bool',
            'cond_otras' => 'required|bool',
            'resource' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cond_electrica' => filter_var($this->input('cond_electrica'), FILTER_VALIDATE_BOOLEAN),
            'cond_mecanica' => filter_var($this->input('cond_mecanica'), FILTER_VALIDATE_BOOLEAN),
            'cond_ambientales' => filter_var($this->input('cond_ambientales'), FILTER_VALIDATE_BOOLEAN),
            'cond_seguridad' => filter_var($this->input('cond_seguridad'), FILTER_VALIDATE_BOOLEAN),
            'cond_transporte' => filter_var($this->input('cond_transporte'), FILTER_VALIDATE_BOOLEAN),
            'cond_otras' => filter_var($this->input('cond_otras'), FILTER_VALIDATE_BOOLEAN),
        ]);
    }

    public function messages()
    {
        return [
            'prohibited' => 'El campo :attribute no es permitido.',
            'required' => 'El campo :attribute es obligatorio',
            'string' => 'El campo :attribute debe ser una cadena de texto',
            'nullable' => 'El campo :attribute es opcional',
            'date' => 'El campo :attribute debe ser una fecha válida.'
        ];
    }

}
