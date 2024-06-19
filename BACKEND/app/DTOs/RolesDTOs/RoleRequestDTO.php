<?php

namespace App\DTOs\RolesDTOs;

class RoleRequestDTO
{
    public $email;
    public $role_id;

    public function __construct($email, $role_id)
    {
        $this->email = $email;
        $this->role_id = $role_id;
    }

    public static function fromArray($data)
    {
        return new self(
            $data["email"] ?? null,
            $data["role_id"] ?? null,
        );
    }

    public function toArray()
    {
        return [
            "email" => $this->email,
            "role_id" => $this->role_id,
        ];
    }
}
