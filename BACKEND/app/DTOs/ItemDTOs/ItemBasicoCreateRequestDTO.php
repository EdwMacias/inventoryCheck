<?php

namespace App\DTOs\ItemDTOs;

class ItemBasicoCreateRequestDTO
{
    // public $item_basico_id;
    // public $item_id;
    public $name;
    public $serie_lote;
    public $valor_adquisicion;
    public $category_id;

    public function __construct(array $itemBasico)
    {
        // $this->item_basico_id = $itemBasico['item_basico_id'] ?? null;
        $this->name = $itemBasico["name"];
        $this->serie_lote = $itemBasico["serie_lote"];
        $this->valor_adquisicion = $itemBasico["valor_adquisicion"];
        $this->category_id = $itemBasico["category_id"];
    }

    public function toArray()
    {
        return [
            // "item_basico_id" => $this->item_basico_id,
            "name" => $this->name,
            "serie_lote" => $this->serie_lote,
            "valor_adquisicion" => $this->valor_adquisicion,
            "category_id" => $this->category_id
        ];
    }

}
