<?php

namespace App\Utils;

class Encriptacion
{
    public static function getEncriptacion($informacion)
    {
        $key = hash(env("HASH"), env("SECRET_KEY_ENCRYPT"));
        $iv = substr(hash(env("HASH"), env("SECRET_IV")), 0, 16);
        $output = openssl_encrypt($informacion, env("METHOD_ENCRYPT"), $key, OPENSSL_RAW_DATA, $iv);
        $output = base64_encode($output);
        return base64_encode($output);
    }

    public static function getDescriptacion($informacion)
    {
        $key = hash(env("HASH"), env("SECRET_KEY_ENCRYPT"));
        $iv = substr(hash(env("HASH"), env("SECRET_IV")), 0, 16);
        $output = openssl_decrypt(base64_decode(base64_decode($informacion)), env("METHOD_ENCRYPT"), $key, OPENSSL_RAW_DATA, $iv);
        return $output;
    }
}
