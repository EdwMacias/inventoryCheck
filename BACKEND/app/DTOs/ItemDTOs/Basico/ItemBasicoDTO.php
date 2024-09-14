<?php

namespace App\DTOs\ItemDTOs\Basico;
use App\Models\Inventory\ItemBasico;

class ItemBasicoDTO
{
    public $itemBasicoId;
    public $itemId;
    public $nombre;
    public $serial;
    public $valor;
    public $createdAt;
    public $updatedAt;

    public function __construct(ItemBasico $itemBasico)
    {
        $this->itemBasicoId = $itemBasico->item_basico_id;
        $this->itemId = $itemBasico->item_id;
        $this->nombre = $itemBasico->name;
        $this->serial = $itemBasico->serie_lote;
        $this->valor = $itemBasico->valor_adquisicion;
        $this->createdAt = $itemBasico->created_at;
        $this->updatedAt = $itemBasico->updated_at;
    }

}
