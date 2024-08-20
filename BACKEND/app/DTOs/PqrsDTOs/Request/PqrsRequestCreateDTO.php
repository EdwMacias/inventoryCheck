<?php

namespace App\DTOs\PqrsDTOs\Request;

class PqrsRequestCreateDTO
{
    public $opcion;
    public $name;
    public $descriptionPQRS;

    public function __construct(array $pqrs)
    {
        $this->name = $pqrs["name"] ?? null;
        $this->opcion = $pqrs["opcion"] ?? null;
        $this->descriptionPQRS = $pqrs["descriptionPQRS"] ?? null;
    }

    public function toArray()
    {
        return [
            "nombre" => $this->name,
            "opcion" => $this->opcion,
            "descripcion" => $this->descriptionPQRS
        ];
    }
}
