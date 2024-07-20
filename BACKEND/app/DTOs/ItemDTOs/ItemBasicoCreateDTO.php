<?php

namespace App\DTOs\ItemDTOs;

class ItemBasicoCreateDTO
{

    //  public $item_basico_id;
    public $item_id;
    public $name;
    public $serie_lote;
    public $valor_adquisicion;
    // public $category_id;

    public function __construct(array $itemBasico)
    {
        // $this->item_basico_id = $itemBasico['item_basico_id'] ?? uuid_create();
        $this->name = $itemBasico["name"];
        $this->serie_lote = $itemBasico["serie_lote"];
        $this->valor_adquisicion = $itemBasico["valor_adquisicion"];
        $this->item_id = $itemBasico["item_id"] ?? null;
    }

    public function toArray()
    {
        return [
            // "item_basico_id" => $this->item_basico_id,
            "name" => $this->name,
            "serie_lote" => $this->serie_lote,
            "valor_adquisicion" => $this->valor_adquisicion,
            "item_id" => $this->item_id
        ];
    }

}
