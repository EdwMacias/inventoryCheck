<?php

namespace App\DTOs\RolesDTOs;

class RoleUserDTO
{
    public $role_id;
    public $user_id;

    public function __construct($role_id, $user_id)
    {
        $this->role_id = $role_id;
        $this->user_id = $user_id;
    }

    public static function fromArray($data)
    {
        return new self(
            $data["user_id"] ?? null,
            $data["role_id"] ?? null,
        );
    }

    public function toArray()
    {
        return [
            "user_id" => $this->user_id,
            "role_id" => $this->role_id,
        ];
    }
}
