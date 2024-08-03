<?php

namespace App\DTOs\Usuario;

class UsuarioResponseDTO
{
    public $user_id;
    public $name;
    public $last_name;
    public $email;
    public $document_type_id;
    public $number_document;
    public $gender_id;
    public $address;
    public $number_telephone;
    public $password;
    public $statu_id;
    public $role;

    public function __construct(
        $user_id,
        $name,
        $last_name,
        $email,
        $document_type_id,
        $number_document,
        $gender_id,
        $address,
        $number_telephone,
        $statu_id
    ) {
        $this->user_id = $user_id;
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->document_type_id = $document_type_id;
        $this->number_document = $number_document;
        $this->gender_id = $gender_id;
        $this->address = $address;
        $this->number_telephone = $number_telephone;
        $this->statu_id = $statu_id;
    }

    public static function fromArray($data)
    {
        return new self(
            $data["user_id"] ?? null,
            $data["name"] ?? null,
            $data["last_name"] ?? null,
            $data["email"] ?? null,
            $data["document_type_id"] ?? null,
            $data["number_document"] ?? null,
            $data["gender_id"] ?? null,
            $data["address"] ?? null,
            $data["number_telephone"] ?? null,
            $data["statu_id"] ?? null,
        );
    }

    public function toArray()
    {
        return [
            "user_id" => $this->user_id,
            "name" => $this->name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "document_type_id" => $this->document_type_id,
            "number_document" => $this->number_document,
            "gender_id" => $this->gender_id,
            "address" => $this->address,
            "number_telephone" => $this->number_telephone,
            "statu_id" => $this->statu_id,
            // "password" => $this->password,
        ];
    }
}
