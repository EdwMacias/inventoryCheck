<?php

namespace App\DTOs\ItemDTOs;

class ItemCreateDTO
{
    public string $item_id;
    public string $name;
    public string $serial_number;
    public string $description;

    public function __construct(string $item_id, string $name, string $serial_number, string $description)
    {
        $this->item_id = $item_id;
        $this->name = $name;
        $this->serial_number = $serial_number;
        $this->description = $description;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['item_id'] ?? uuid_create(),
            $data['name'] ?? null,
            $data['serial_number'] ?? null,
            $data['description'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'item_id' => $this->item_id,
            'name' => $this->name,
            'serial_number' => $this->serial_number,
            'description' => $this->description,
        ];
    }

}
