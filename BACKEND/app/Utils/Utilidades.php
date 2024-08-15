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

    public static function sanitizeString($string) {
        // Eliminar acentos y convertir en una cadena sin caracteres especiales
        $string = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
        // Reemplazar cualquier carácter que no sea alfanumérico por un guion bajo
        $string = preg_replace('/[^a-zA-Z0-9]/', '', $string);
        return strtolower(trim($string));
    }
    
}
