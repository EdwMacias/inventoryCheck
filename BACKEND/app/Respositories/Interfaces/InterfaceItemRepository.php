<?php

namespace App\Respositories\Interfaces;

interface InterfaceItemRepository
{
    public function create(array $item): bool;
    public function update($id, array $item);
    public function delete($id);
    public function inactivate($id);
    public function active($id);
    public function getItemByName(string $name): bool;
    public function getItemBySerialNumber(string $serialNumber): bool;
}
