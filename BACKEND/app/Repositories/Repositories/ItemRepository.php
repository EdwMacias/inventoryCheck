<?php

namespace App\Repositories\Repositories;

use App\DTOs\ItemDTOs\ItemCreateDTO;
use App\Models\Inventory\Item;
use App\Repositories\Interfaces\InterfaceItemRepository;

class ItemRepository implements InterfaceItemRepository
{

    /**
     *
     * @param mixed $id
     */
    public function active($id)
    {
        $itemModel = Item::find($id);
        $itemModel->statu_id = 1;
        return $itemModel->save();
    }

    /**
     *
     * @param ItemCreateDTO $item
     * @return bool
     */
    public function create(ItemCreateDTO $item): bool
    {
        $itemModel = new Item($item->toArray());
        $itemModel->statu_id = 1;
        return $itemModel->save();
    }

    /**
     *
     * @param mixed $id
     */
    public function delete($id)
    {
        $itemModel = Item::on()->find($id);
        return $itemModel->delete();
    }

    /**
     *
     * @param mixed $id
     */
    public function inactivate($id)
    {
        $itemModel = Item::on()->find($id);
        $itemModel->statu_id = 0;
        return $itemModel->save();
    }

    /**
     *
     * @param mixed $id
     * @param array $item
     */
    public function update($id, array $item)
    {
        $itemModel = Item::on()->find($id);
        return $itemModel->update($item);
    }


    public function getItemByName(string $name): bool
    {
        $item = Item::where('name', $name)->exists();
        return $item;
    }
    /**
     *
     * @param string $serialNumber
     * @return bool
     */
    public function getItemBySerialNumber(string $serialNumber): bool
    {
        $item = Item::where('serial_number', $serialNumber)->exists();
        return $item;
    }
    /**
     *
     * @param string $itemId id del item a buscar
     * @return bool --Retorna true si existe false si no existe
     */
    public function existItemByItemId(string $itemId): bool
    {
        return Item::where('item_id', $itemId)->exists();
    }
}
