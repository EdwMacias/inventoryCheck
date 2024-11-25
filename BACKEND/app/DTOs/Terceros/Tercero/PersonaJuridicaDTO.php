<?php

namespace App\DTOs\Terceros\Tercero;

class PersonaJuridicaDTO
{
    private $id;
    private $razonSocial;
    private $nit;
    private $tipoEntidad;
    private $fechaRegistroCamara;
    private $numeroRegistro;
    private $pais;
    private $representanteLegal;
    private $telefono;
    private $email;

    public function __construct($personaJuridica = null) {
        $this->id = $personaJuridica->id;
        $this->razonSocial = $personaJuridica->razon_social;
        $this->nit = $personaJuridica->nit;
        $this->tipoEntidad = $personaJuridica->tipo_entidad;
        $this->fechaRegistroCamara = $personaJuridica->registro_camara_comercio;
        $this->numeroRegistro = $personaJuridica->numero_registro_camara_comercio;
        $this->pais = $personaJuridica->pais;
        $this->representanteLegal = $personaJuridica->representante_legal;
        $this->telefono = $personaJuridica->telefono;
        $this->email = $personaJuridica->email;
    }
    
}
