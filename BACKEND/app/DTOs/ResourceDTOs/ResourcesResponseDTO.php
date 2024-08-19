<?php

namespace App\DTOs\ResourceDTOs;

class ResourcesResponseDTO
{
    public string $resource;
    public string $audiovisual_resource_id;
    public $item_id;
    public $item_observation_id;
    public $created_at;
    public $updated_at;

    public function __construct($visualResource)
    {
        $this->audiovisual_resource_id = $visualResource->audiovisual_resource_id;
        $this->item_id = $visualResource->item_id;
        $this->item_observation_id = $visualResource->item_observation_id;
        $this->resource = url($visualResource->resource);
        $this->created_at = $visualResource->created_at;
        $this->updated_at = $visualResource->updated_at;
    }

}
