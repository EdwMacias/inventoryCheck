<?php

namespace App\Utils;

class Utilidades
{

    public static function EncriptarPassword(string $password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function VerificarPassword(string $password, string $passwordHash)
    {
        return password_verify($password, $passwordHash);
    }

    public static function sanitizeString($string)
    {
        // Eliminar acentos y convertir en una cadena sin caracteres especiales
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        // Reemplazar cualquier carácter que no sea alfanumérico por un guion bajo
        $string = preg_replace('/[^a-zA-Z0-9]/', '', $string);
        return strtolower(trim($string));
    }

    /**
     * Concatenar y limpiar una lista de strings, manejando valores nulos.
     *
     * @param array<string> $componentes Lista de datos en string.
     * @return string retorna el string concatenado y limpio.
     */
    public static function concatenarYLimpiar(array $componentes): string
    {
        return trim(implode(' ', array_filter($componentes, function ($valor) {
            return !is_null($valor) && $valor !== '';
        })));
    }

    /**
     * Convierte la fecha a formato Y-m-d probando múltiples formatos
     * @param string|null $fecha
     * @return string|null
     */
    public static function normalizeFecha(?string $fecha): ?string
    {
        if ($fecha) {
            // Array de formatos de fecha permitidos
            $formatosPermitidos = ['d-m-Y', 'm-d-Y', 'Y-m-d'];

            foreach ($formatosPermitidos as $formato) {
                $date = \DateTime::createFromFormat($formato, $fecha);
                // Verifica si la fecha es válida con el formato actual
                if ($date && $date->format($formato) === $fecha) {
                    return $date->format('Y-m-d'); // Devuelve en formato Y-m-d
                }
            }
        }
        return null; // Retorna null si no se puede normalizar la fecha
    }

}
