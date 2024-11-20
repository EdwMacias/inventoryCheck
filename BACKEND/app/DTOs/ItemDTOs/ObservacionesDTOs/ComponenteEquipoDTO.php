<?php

namespace App\DTOs\ItemDTOs\ObservacionesDTOs;

use EquipoConfig;

class ComponenteEquipoDTO
{
    public $itemId;
    public $serial;
    public $cantidad;
    public $cuidados = null;
    public $marca = null;
    public $modelo = null;
    public $nombre = null;
    public $unidad = null;
    public $type;

    public function __construct($componente)
    {
        $this->itemId = $componente->item_id ?? null;
        $this->serial = $componente->serial ?? null;
        $this->cantidad = $componente->cantidad ?? null;
        $this->cuidados = $componente->cuidados ?? null;
        $this->marca = $componente->marca ?? null;
        $this->modelo = $componente->modelo ?? null;
        $this->nombre = $componente->nombre ?? null;
        $this->unidad = $componente->unidad ?? null;
        $this->type = $componente->type ?? EquipoConfig::TYPE_ORIGINAL;
    }


    public function toArray()
    {
        return [
            "item_id" => $this->itemId,
            "serial" => $this->serial,
            "cantidad" => $this->cantidad,
            "cuidados" => $this->cuidados,
            "marca" => $this->marca,
            "modelo" => $this->modelo,
            "nombre" => $this->nombre,
            "unidad" => $this->unidad,
            "type" => $this->type
        ];
    }

}
