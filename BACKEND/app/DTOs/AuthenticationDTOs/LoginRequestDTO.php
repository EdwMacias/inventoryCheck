<?php

namespace App\DTOs\AuthenticationDTOs;

class LoginRequestDTO
{
    public $email;
    public $password;

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public static function fromArray($data)
    {
        return new self(
            $data["email"] ?? null,
            $data["password"] ?? null,
        );
    }

    public function toArray()
    {
        return [
            "email" => $this->email,
            "password" => $this->password
        ];
    }

}
