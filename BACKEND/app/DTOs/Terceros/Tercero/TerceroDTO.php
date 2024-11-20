<?php

namespace App\DTOs\Terceros\Tercero;

use App\Models\Terceros\Tercero;

class TerceroDTO
{
    public $terceroId;
    public $documento;
    public $nDocumento;
    public $tipoPersona;
    public $razonSocial;
    public $primerNombre;
    public $segundoNombre;
    public $primerApellido;
    public $segundoApellido;
    public $email;
    public $ubicacion;
    // public $direccion;
    // public $ciudad;
    // public $departamento;
    // public $pais;
    public $telefono;
    public $foto;
    public $createdAt;
    public $updatedAt;

    public function __construct(Tercero $tercero)
    {
        $this->terceroId = $tercero->terceroId;
        $this->documento = $tercero->infoTipoDocumento;
        $this->tipoPersona = $tercero->infoTipoPersona;
        $this->nDocumento = $tercero['#documento'];
        $this->razonSocial = $tercero->razonSocial;
        $this->primerNombre = $tercero->primerNombre;
        $this->segundoNombre = $tercero->segundoNombre;
        $this->primerApellido = $tercero->primerApellido;
        $this->segundoApellido = $tercero->segundoApellido;
        $this->email = $tercero->email;
        $this->ubicacion = [
            'direccion' => $tercero->direccion,
            'ciudad' => $tercero->ciudad,
            'departamento' => $tercero->departamento,
            'pais' => $tercero->pais
        ];
        // $this->pais = $tercero->pais;
        $this->telefono = $tercero->telefono;
        $this->foto = $tercero->foto;
        $this->createdAt = $tercero->created_at;
        $this->updatedAt = $tercero->updated_at;

    }

}
