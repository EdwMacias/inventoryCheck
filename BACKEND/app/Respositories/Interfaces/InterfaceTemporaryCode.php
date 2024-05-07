<?php

namespace App\Respositories\Interfaces;

interface InterfaceTemporaryCode
{
    public function createTemporaryCode(string $code);
    // public function getTemporaryCode($code);
    public function temporaryCodeExpiring(string $code);
    public function temporaryCodeValidWhitUser(string $code, int $user_id): string;
}
