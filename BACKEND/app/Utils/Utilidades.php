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
}
