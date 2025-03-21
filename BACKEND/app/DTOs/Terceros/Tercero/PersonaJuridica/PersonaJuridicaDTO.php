<?php

namespace App\DTOs\Terceros\Tercero\PersonaJuridica;

class PersonaJuridicaDTO
{
    public $personaJuridicaId;
    public $razonSocial;
    public $nit;
    public $tipoEntidad = null;
    public $fechaRegistroCamara = null;
    public $numeroRegistro = null;
    public $pais = null;
    public $representanteLegal = null;
    public $telefono;
    public $correo;
    public $createdAt = null;
    public $updatedAt = null;

    public function __construct($personaJuridica = null)
    {
        $this->personaJuridicaId = $personaJuridica->id;
        $this->razonSocial = $personaJuridica->razon_social;
        $this->nit = $personaJuridica->nit;
        $this->tipoEntidad = $personaJuridica->tipo_entidad;
        $this->fechaRegistroCamara = $personaJuridica->registro_camara_comercio;
        $this->numeroRegistro = $personaJuridica->numero_registro_camara_comercio;
        $this->pais = $personaJuridica->pais;
        $this->representanteLegal = $personaJuridica->representante_legal;
        $this->telefono = $personaJuridica->telefono;
        $this->correo = $personaJuridica->email;
        $this->createdAt = $personaJuridica->created_at;
        $this->updatedAt = $personaJuridica->updated_at;
    }
}
