<?php

namespace App\Respositories\Repositories;

use App\Models\Inventory\Item;
use App\Respositories\Interfaces\InterfaceItemRepository;

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
     * @param array $item
     * @return bool
     */
    public function create(array $item): bool
    {
        $itemModel = new Item($item);
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
}
