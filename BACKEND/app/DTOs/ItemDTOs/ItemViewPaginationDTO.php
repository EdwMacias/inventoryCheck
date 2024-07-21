<?php

namespace App\DTOs\ItemDTOs;

class ItemViewPaginationDTO
{
    public string $item_id;
    public string $name;
    public string $serie_lote;
    public string $category_id;
    public string $resource;
    public string $created_at;
    public string $updated_at;

    public function __construct($item)
    {
        $this->item_id = $item->item_id;
        $this->name = $item->name;
        $this->resource = url($item->resource);
        $this->category_id = $item->category_id;
        $this->serie_lote = $item->serie_lote;
        $this->created_at = $item->created_at;
        $this->updated_at = $item->updated_at;
    }

    public static function fromModel($item): self
    {
        return new self($item);
    }

}
