<?php

namespace App\Config\Items\Oficina;

final class OficinaConfig
{

    public static function getPathFile(): string
    {
        return env('PATH_SAVE_IMAGE_OFICINA', "imagenes/item/basico/");
    }
}
