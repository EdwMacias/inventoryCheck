<?php

namespace App\DTOs\Terceros\TipoPersona;

use App\Models\Terceros\TipoPersona;

class TipoPersonaDTO
{
    public $id;
    public $nombre;
    public $codigo;
    public $createdAt;
    public $updateAt;

    public function __construct(TipoPersona $tipoPersona) {
        $this->id = $tipoPersona->tipoPersonaId;
        $this->nombre = $tipoPersona->nombre;
        $this->codigo = $tipoPersona->codigo;
        $this->createdAt = $tipoPersona->created_at;
        $this->updateAt = $tipoPersona->updated_at;
    }
}
