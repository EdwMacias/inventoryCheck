<?php

namespace App\DTOs\ItemDTOs;

class ItemCreateDTO
{
    public string $item_id;
    public string $category_id;
    public string $statu_id;

    public function __construct(string $item_id, string $category_id, string $statu_id)
    {
        $this->item_id = $item_id;
        $this->category_id = $category_id;
        $this->statu_id = $statu_id;
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['item_id'] ?? uuid_create(),
            $data['category_id'] ?? null,
            $data["statu_id"] ?? TRUE
        );
    }

    public function toArray(): array
    {
        return [
            'item_id' => $this->item_id,
            'category_id' => $this->category_id,
            'statu_id' => $this->statu_id
        ];
    }

}
