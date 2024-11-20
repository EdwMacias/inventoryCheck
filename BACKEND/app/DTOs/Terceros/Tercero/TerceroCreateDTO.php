<?php

namespace App\DTOs\Terceros\Tercero;

class TerceroCreateDTO
{
    public $tipoDocumentoId;
    public $numeroDocumento;
    public $tipoPersonaId;
    public $razonSocial;
    public $primerNombre;
    public $segundoNombre;
    public $primerApellido;
    public $segundoApellido;
    public $email;
    public $direccion;
    public $ciudad;
    public $departamento;
    public $pais;
    public $telefono;
    public $foto;
    public function __construct($tercero)
    {
        $this->tipoDocumentoId = $tercero->tipoDocumentoId;
        $this->tipoPersonaId = $tercero->tipoPersonaId;
        $this->numeroDocumento = $tercero->numeroDocumento;
        $this->razonSocial = $tercero->razonSocial;
        $this->primerNombre = $tercero->primerNombre;
        $this->segundoNombre = $tercero->segundoNombre;
        $this->primerApellido = $tercero->primerApellido;
        $this->segundoApellido = $tercero->segundoApellido;
        $this->email = $tercero->email;
        $this->direccion = $tercero->direccion;
        $this->ciudad = $tercero->ciudad;
        $this->departamento = $tercero->departamento;
        $this->pais = $tercero->pais;
        $this->telefono = $tercero->telefono;
        $this->foto = $tercero->foto;
    }
}
