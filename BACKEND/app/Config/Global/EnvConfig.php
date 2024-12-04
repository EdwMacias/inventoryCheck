<?php

namespace App\Config\Global;

final class EnvConfig
{
    public static function getDefaulSaveFiles(): string
    {
        return env('DEFAULT_SAVE_FILES', 'storage');
    }
}
