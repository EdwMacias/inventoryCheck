<?php

namespace App\Respositories\Repositories;

use App\Respositories\Interfaces\InterfaceTemporaryCode;
use App\Models\TemporaryCode;

class TemporaryCodeRepository implements InterfaceTemporaryCode
{
    /**
     *
     * @param string $code
     * @return string
     */
    public function createTemporaryCode(string $code, int $user_id)
    {
        return TemporaryCode::create([
            "code" => $code,
            'expires_at' => now()->addMinutes(15),
            'user_id' => $user_id
        ]);
    }

    /**
     *
     * @param string $code
     * 
     */
    public function temporaryCodeExpiring(string $code)
    {
        return TemporaryCode::where('code', $code)
            ->where('expires_at', '>', now())
            ->where('is_used', false)
            ->first();
    }

    /**
     *
     * @param string $code
     * @param int $user_id
     * @return string
     */
    public function temporaryCodeValidWhitUser(string $code, int $user_id): string
    {
        return TemporaryCode::where('code', $code)
            ->where('expires_at', '>', now())
            ->where('is_used', false)
            ->where('user_id', $user_id)
            ->first();
    }
    /**
     *
     * @param int $user_id
     */
    public function cleanTemporaryCode(int $user_id)
    {
        return TemporaryCode::where('user_id', $user_id)->delete();
    }
}
