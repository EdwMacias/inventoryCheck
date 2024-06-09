<?php

namespace App\DTOs\Usuario;

class UsuarioCreateDTO
{
    public $name;
    public $last_name;
    public $email;
    public $document_type_id;
    public $number_document;
    public $gender_id;
    public $address;
    public $number_telephone;
    public $password;

    public function __construct(
        $name,
        $last_name,
        $email,
        $document_type_id,
        $number_document,
        $gender_id,
        $address,
        $number_telephone
    ) {
        $this->name = $name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->document_type_id = $document_type_id;
        $this->number_document = $number_document;
        $this->gender_id = $gender_id;
        $this->address = $address;
        $this->number_telephone = $number_telephone;
    }

    public static function fromArray($data)
    {
        return new self(
            $data["name"] ?? null,
            $data["last_name"] ?? null,
            $data["email"] ?? null,
            $data["document_type_id"] ?? null,
            $data["number_document"] ?? null,
            $data["gender_id"] ?? null,
            $data["address"] ?? null,
            $data["number_telephone"] ?? null,
        );
    }

    public function toArray()
    {
        return [
            "name" => $this->name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "document_type_id" => $this->document_type_id,
            "number_document" => $this->number_document,
            "gender_id" => $this->gender_id,
            "address" => $this->address,
            "number_telephone" => $this->number_telephone,
            "password" => $this->password,
        ];
    }

}
