<?php

namespace App\DTOs\ItemDTOs\Basico;
use App\DTOs\Unidades\UnidadDTO;
use App\Models\Inventory\ItemBasico;

class ItemBasicoDTO
{
    public $itemBasicoId;
    public $itemId;
    public $nombre;
    public $serial;
    public $valor;
    public $unidad;
    public $cantidad;
    public $createdAt;
    public $updatedAt;

    public function __construct(ItemBasico $itemBasico)
    {
        $this->itemBasicoId = $itemBasico->item_basico_id ?? null;
        $this->itemId = $itemBasico->item_id ?? null;
        $this->nombre = $itemBasico->name ?? null;
        $this->serial = $itemBasico->serie_lote ?? null;
        $this->valor = $itemBasico->valor_adquisicion ?? null;
        $this->cantidad = $itemBasico->cantidad ?? null;
        $this->unidad = $itemBasico->unidades ? new UnidadDTO($itemBasico->unidades ?? null) : null;
        $this->createdAt = $itemBasico->created_at ?? null;
        $this->updatedAt = $itemBasico->updated_at ?? null;
    }

}
