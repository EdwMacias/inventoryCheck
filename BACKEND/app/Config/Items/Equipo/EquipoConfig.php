<?php

final class EquipoConfig
{
    public const TYPE_ORIGINAL = 'original';
    public const TYPE_REPUESTO = 'repuesto';

    public static function getValidTypes(): array
    {
        return [
            self::TYPE_ORIGINAL,
            self::TYPE_REPUESTO,
        ];
    }
}



