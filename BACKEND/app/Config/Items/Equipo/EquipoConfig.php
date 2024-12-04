<?php

namespace App\Config\Items\Equipo;

final class EquipoConfig
{
    public static function getTypeOriginal()
    {
        return env('TYPE_EQUIPO_ORIGINAL', 'original');
    }

    public static function getTypeRepuesto()
    {
        return env('TYPE_EQUIPO_REPUESTO', 'repuesto');
    }
    public static function getPathFile(): string
    {
        return env('PATH_SAVE_IMAGE_EQUIPO', 'imagenes/item/equipo');
    }
    public static function getValidTypes(): array
    {
        return [
            self::getTypeOriginal(),
            self::getTypeRepuesto(),
        ];
    }
}



