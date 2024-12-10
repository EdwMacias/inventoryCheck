<?php

namespace App\DTOs\Terceros\Tercero\PersonaNatural;

class PersonaNaturalDTO
{
    public ?int $personaNaturalId = null;
    public string $primerNombre;
    public ?string $segundoNombre = null;
    public string $primerApellido;
    public ?string $segundoApellido = null;
    public string $tipoIdentificacion;
    public string $numeroIdentificacion;
    public string $telefono;
    public ?string $correo = null;
    public string $direccion;
    public string $departamento;
    public string $ciudad;
    public ?string $dv = null;
    public $documento = null;
    public ?string $createdAt = null;
    public ?string $updatedAt = null;

    public function __construct($personaNatural)
    {
        $this->personaNaturalId = $personaNatural->id;
        $this->primerNombre = $personaNatural->primer_nombre;
        $this->segundoNombre = $personaNatural->segundo_nombre;
        $this->primerApellido = $personaNatural->primer_apellido;
        $this->segundoApellido = $personaNatural->segundo_apellido;
        $this->tipoIdentificacion = $personaNatural->document_type_id;
        $this->numeroIdentificacion = $personaNatural->numero_identificacion;
        $this->telefono = $personaNatural->telefono;
        $this->direccion = $personaNatural->direccion;
        $this->departamento = $personaNatural->departamento;
        $this->ciudad = $personaNatural->ciudad;
        $this->correo = $personaNatural->correo;
        $this->dv = $personaNatural->dv;
        $this->documento = $personaNatural->documento ?? null;
        $this->createdAt = $personaNatural->created_at;
        $this->updatedAt = $personaNatural->updated_at;
    }
}
