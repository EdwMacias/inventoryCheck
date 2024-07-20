<?php

namespace App\DTOs\ItemDTOs;

class ItemViewPaginationDTO
{
    public string $item_id;
    public string $name;
    public string $serial_number;
    // public string $description;
    public string $resource;

    public function __construct($item)
    {
        $this->item_id = $item->item_id;
        $this->name = $item->name;
        $this->resource = url($item->resource);
        // $this->description = $item->description;
        $this->description = $item->serial_number;
    }

    public static function fromModel($item): self
    {
        return new self($item);
    }

}
