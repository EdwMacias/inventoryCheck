<?php

namespace App\DTOs\ItemDTOs;

class ItemObservationDTO
{
    public $observation;
    public $item_id;
    public $user_id;
    public $types_observation_id;

    public function __construct($observation, $item_id, $user_id, $types_observation_id)
    {
        $this->observation = $observation;
        $this->item_id = $item_id;
        $this->user_id = $user_id;
        $this->types_observation_id = $types_observation_id;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['observation'] ?? null,
            $data['item_id'] ?? null,
            $data['user_id'] ?? null,
            $data['types_observation_id'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'observation' => $this->observation,
            'types_observation_id' => $this->types_observation_id,
            'item_id' => $this->item_id,
            'user_id' => $this->user_id,
        ];
    }
}
