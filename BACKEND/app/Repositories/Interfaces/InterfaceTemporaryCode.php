<?php

namespace App\Repositories\Interfaces;

interface InterfaceTemporaryCode
{
    public function createTemporaryCode(string $code, int $user_id);
    public function temporaryCodeExpiring(string $code);

    /**
     *
     * @param string $code
     * @param int $user_id
     * @return object|\App\Models\TemporaryCode|null
     */
    public function temporaryCodeValidWhitUser(string $code, int $user_id);
    public function cleanTemporaryCode(int $user_id);
}
