<?php

namespace App\DTOs\ItemDTOs;
use App\DTOs\ResourceDTOs\ResourcesResponseDTO;

class ItemViewPaginationDTO
{
    public string $item_id;
    public string $name;
    public string $serie_lote;
    public string $category_id;

    public string $resource;
    /**
     * @var array<ResourcesResponseDTO>
     */
    public array $resources;
    public string $created_at;
    public string $updated_at;

    public function __construct($item)
    {
        $this->item_id = $item->item_id;

        if ($item->equipo) {
            $this->name = $item->equipo->name;
            $this->resource = (!empty($item->equipo->resource) && isset($item->equipo->resource[0])) ? url($item->equipo->resource[0]->resource) : null;
            foreach ($item->equipo->resource ?? [] as $resource) {
                $this->resources[] = new ResourcesResponseDTO($resource);
            }
            $this->serie_lote = $item->equipo->serie_lote;
        } else {
            $this->name = $item->itemBasico->name;
            $this->resource = (!empty($item->itemBasico->resource) && isset($item->itemBasico->resource[0])) ? url($item->itemBasico->resource[0]->resource) : null;
            foreach ($item->itemBasico->resource ?? [] as $resource) {
                $this->resources[] = new ResourcesResponseDTO($resource);
            }
            $this->serie_lote = $item->itemBasico->serie_lote;
        }

        $this->category_id = $item->category_id;
        $this->created_at = $item->created_at;
        $this->updated_at = $item->updated_at;
    }

    public static function fromModel($item): self
    {
        return new self($item);
    }

}
