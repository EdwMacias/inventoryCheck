<?php

namespace App\DTOs\ItemDTOs\EquiposDTOs;

class EquipoComponenteDTO
{
    public $id;
    public $itemId;
    public $serial;
    public $cantidad;
    public $cuidados;
    public $modelo;
    public $marca;
    public $nombre;
    public $unidad;
    public $tipo;
    public $createdAt;
    public $updatedAt;

    public function __construct($equipoComponente)
    {
        $this->id = $equipoComponente->equipo_compt_id;
        $this->itemId = $equipoComponente->item_id;
        $this->serial = $equipoComponente->serial;
        $this->cantidad = $equipoComponente->cantidad;
        $this->cuidados = $equipoComponente->cuidados;
        $this->modelo = $equipoComponente->modelo;
        $this->marca = $equipoComponente->marca;
        $this->nombre = $equipoComponente->nombre;
        $this->unidad = $equipoComponente->unidad;
        $this->tipo = $equipoComponente->type;
        $this->createdAt = $equipoComponente->created_at;
        $this->updatedAt = $equipoComponente->updated_at;
    }
}
