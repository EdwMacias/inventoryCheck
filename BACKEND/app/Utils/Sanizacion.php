<?php

namespace App\Utils;

use HTMLPurifier;
use HTMLPurifier_Config;

class Sanizacion
{

    /**
     * @param mixed $value
     * Valor a pasar para ser sanizado
     * @return string
     */
    public static function cleanInput($value): string
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);

        $cleanedValue = $purifier->purify($value);
        return strip_tags($cleanedValue);
    }
}
