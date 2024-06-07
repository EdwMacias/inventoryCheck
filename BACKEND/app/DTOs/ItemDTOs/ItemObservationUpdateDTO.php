<?php

namespace App\DTOs\ItemDTOs;

class ItemObservationUpdateDTO
{
    public $observation;
    public $types_observation_id;

    public function __construct($observation, $types_observation_id)
    {
        $this->observation = $observation;
        $this->types_observation_id = $types_observation_id;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['observation'] ?? null,
            $data['types_observation_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'observation' => $this->observation,
            'types_observation_id' => $this->types_observation_id,
        ];
    }
}
