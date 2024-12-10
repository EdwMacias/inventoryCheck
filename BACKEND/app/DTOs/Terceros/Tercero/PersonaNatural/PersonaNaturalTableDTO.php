<?php

namespace App\DTOs\Terceros\Tercero\PersonaNatural;

use App\Utils\Utilidades;

class PersonaNaturalTableDTO
{
    public $personaNaturalId;
    public $nombre;
    public $numeroIdentificacion;
    public $tipoDocumentoId;
    public $identificacion;
    public $dv;
    public $telefono;
    public $correo;
    public $createdAt;
    public $updatedAt;
    public function __construct($personaNatural)
    {
        $this->personaNaturalId = $personaNatural->id ?? null;
        $this->numeroIdentificacion = $personaNatural->numero_identificacion ?? null;
        $this->identificacion = $personaNatural->documento->name ?? null;
        $this->tipoDocumentoId = $personaNatural->document_type_id ?? null;
        $this->telefono = $personaNatural->telefono ?? null;
        $this->correo = $personaNatural->correo ?? null;
        $this->dv = $personaNatural->dv ?? null;
        $this->nombre = Utilidades::concatenarYLimpiar([
            $personaNatural->primer_nombre,
            $personaNatural->segundo_nombre,
            $personaNatural->primer_apellido,
            $personaNatural->segundo_apellido,
        ]);
        $this->createdAt = $personaNatural->created_at ?? null;
        $this->updatedAt = $personaNatural->updated_at ?? null;
        // $this->var = $var;
    }

}

