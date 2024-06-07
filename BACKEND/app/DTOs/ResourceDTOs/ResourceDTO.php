<?php

namespace App\DTOs\ResourceDTOs;

class ResourceDTO
{

    public string $resource;
    public $item_id;
    public $item_observation_id;
    public function __construct(string $resource, $item_id, $item_observation_id)
    {
        $this->resource = $resource;
        $this->item_id = $item_id;
        $this->item_observation_id = $item_observation_id;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['resource'] ?? null,
            $data['item_id'] ?? null,
            $data['item_observation_id'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'resource' => $this->resource,
            'item_observation_id' => $this->item_observation_id,
            'item_id' => $this->item_id,
        ];
    }

}
