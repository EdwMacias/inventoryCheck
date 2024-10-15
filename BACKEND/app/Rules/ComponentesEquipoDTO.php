<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ComponentesEquipoDTO implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Verifica que cada valor en componentes sea un array
        $value = json_decode($value, true);

        if (!is_array($value)) {
            $fail("El campo :attribute debe ser un objeto válido. $value");
            return;
        }

        // Define los atributos que deben estar presentes
        $keys = ['serial', 'nombre', 'marca', 'modelo', 'cantidad', 'unidad', 'cuidados'];
        $requiredKeys = ['serial', 'cantidad'];
        // Verifica que todos los atributos requeridos estén presentes
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $value)) {
                $fail("El campo :attribute debe contener el atributo '$key'.");
                return;
            }
        }

        // Verifica que 'cantidad' sea un número entero
        if (!is_int($value['cantidad'])) {
            $fail("El campo 'cantidad' en :attribute debe ser un número entero.");
            return;
        }

        // Verifica que no haya atributos adicionales
        $extraKeys = array_diff(array_keys($value), $keys);
        if (count($extraKeys) > 0) {
            $fail("El campo :attribute contiene atributos no permitidos: " . implode(', ', $extraKeys) . ".");
            return;
        }
    }
}
