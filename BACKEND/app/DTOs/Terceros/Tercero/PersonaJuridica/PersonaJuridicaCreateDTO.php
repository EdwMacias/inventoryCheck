<?php

namespace App\DTOs\Terceros\Tercero\PersonaJuridica;

class PersonaJuridicaCreateDTO
{
    public $razonSocial;
    public $nit;
    public $tipoEntidad = null;
    public $fechaRegistroCamara = null;
    public $numeroRegistro = null;
    public $pais = null;
    public $representanteLegal = null;
    public $telefono;
    public $email;
    public function __construct($personaJuridica = null)
    {
        $this->razonSocial = $personaJuridica->razonSocial;
        $this->nit = $personaJuridica->nit;
        $this->tipoEntidad = $personaJuridica->tipoEntidad;
        $this->fechaRegistroCamara = $personaJuridica->fechaRegistroCamara;
        $this->numeroRegistro = $personaJuridica->numeroRegistro;
        $this->pais = $personaJuridica->pais;
        $this->representanteLegal = $personaJuridica->representanteLegal;
        $this->telefono = $personaJuridica->telefono;
        $this->email = $personaJuridica->email;
    }

    public function toArray()
    {
        return [
            'razon_social' => $this->razonSocial,
            'nit' => $this->nit,
            'tipo_entidad' => $this->tipoEntidad,
            'registro_camara_comercio' => $this->fechaRegistroCamara,
            'numero_registro_camara_comercio' => $this->numeroRegistro,
            'pais' => $this->pais,
            'representante_legal' => $this->representanteLegal,
            'telefono' => $this->telefono,
            'email' => $this->email,
        ];
    }

}
