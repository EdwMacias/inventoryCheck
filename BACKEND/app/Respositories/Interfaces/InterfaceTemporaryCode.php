<?php

namespace App\Respositories\Interfaces;

interface InterfaceTemporaryCode
{
    public function createTemporaryCode(string $code, int $user_id);
    public function temporaryCodeExpiring(string $code);
    public function temporaryCodeValidWhitUser(string $code, int $user_id): string;
    public function cleanTemporaryCode(int $user_id);
}
