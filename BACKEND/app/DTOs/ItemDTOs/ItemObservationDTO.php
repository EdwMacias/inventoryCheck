<?php

namespace App\DTOs\ItemDTOs;

class ItemObservationDTO
{
    public $item_observation_id;
    public $observation;
    public $item_id;
    public $user_id;
    public $types_observation_id;

    public function __construct($item_observation_id,$observation, $item_id, $user_id, $types_observation_id)
    {
        $this->item_observation_id = $item_observation_id;
        $this->observation = $observation;
        $this->item_id = $item_id;
        $this->user_id = $user_id;
        $this->types_observation_id = $types_observation_id;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            uuid_create(),
            $data['observation'] ?? null,
            $data['item_id'] ?? null,
            $data['user_id'] ?? null,
            $data['types_observation_id'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'item_observation_id' => $this->item_observation_id,
            'observation' => $this->observation,
            'types_observation_id' => $this->types_observation_id,
            'item_id' => $this->item_id,
            'user_id' => $this->user_id,
        ];
    }
}
