<?php

namespace App\DTOs\Terceros\Tercero\PersonaJuridica;

class PersonaJuridicaTableDTO
{
    public $personaJuridicaId;
    public $razonSocial;
    public $nit;
    public $telefono;
    public $correo;
    public $createdAt;
    public $updatedAt;

    public function __construct($personaJuridica = null)
    {
        $this->personaJuridicaId = $personaJuridica->id ?? null;
        $this->razonSocial = $personaJuridica->razon_social ?? null;
        $this->nit = $personaJuridica->nit ?? null;
        $this->telefono = $personaJuridica->telefono ?? null;
        $this->correo = $personaJuridica->email ?? null;
        $this->createdAt = $personaJuridica->created_at ?? null;
        $this->updatedAt = $personaJuridica->updated_at ?? null;
    }
}
