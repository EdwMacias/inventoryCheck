<?php

namespace App\DTOs\Unidades;
use App\Models\Unidades;

class UnidadDTO
{
    public $unidadId;
    public $nombre;
    public $codigo;

    public function __construct(Unidades $unidades)
    {
        $this->nombre = $unidades->nombre ?? null;
        $this->unidadId = $unidades->unidad_id ?? null;
        $this->codigo = $unidades->codigo ?? null;
    }

}
