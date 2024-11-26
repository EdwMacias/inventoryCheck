<?php

namespace App\DTOs\Terceros\Tercero\PersonaNatural;

class PersonaNaturalDTO
{
    public ?int $id = null;
    public string $primerNombre;
    public string $segundoNombre;
    public string $primerApellido;
    public string $segundoApellido;
    public string $tipoIdenticacion;
    public string $numeroIdentificacion;
    public string $telefono;
    public string $correo;
    public string $direccion;
    public string $departamento;
    public string $ciudad;
    public ?string $dv = null;
    public ?string $createdAt = null;
    public ?string $updatedAt = null;

    public function __construct($personaNatural)
    {
        $this->id = $personaNatural->id;
        $this->primerNombre = $personaNatural->primer_nombre;
        $this->segundoNombre = $personaNatural->segundo_nombre;
        $this->primerApellido = $personaNatural->primer_apellido;
        $this->segundoApellido = $personaNatural->segundo_apellido;
        $this->tipoIdenticacion = $personaNatural->document_type_id;
        $this->numeroIdentificacion = $personaNatural->numero_identificacion;
        $this->telefono = $personaNatural->telefono;
        $this->direccion = $personaNatural->direccion;
        $this->departamento = $personaNatural->departamento;
        $this->ciudad = $personaNatural->ciudad;
        $this->dv = $personaNatural->dv;
        $this->createdAt = $personaNatural->created_at;
        $this->updatedAt = $personaNatural->updated_at;
    }
}
