<?php

namespace App\Repositories\Interfaces;
use App\DTOs\ItemDTOs\ItemCreateDTO;
use Illuminate\Pagination\LengthAwarePaginator;

interface InterfaceItemRepository
{
    public function create(ItemCreateDTO $item): bool;
    public function update($id, array $item);
    public function delete($id);
    public function inactivate($id);
    public function active($id);
    public function getItemByName(string $name): bool;
    public function getItemBySerialNumber(string $serialNumber): bool;
    /**
     *
     * @param string $itemId id del item a buscar
     * @return bool --Retorna true si existe false si no existe
     */
    public function existItemByItemId(string $itemId): bool;
    /**
     * @param string $perPage
     * Cantidad de items a mostrar
     * @param string $page 
     * pagina a cargar
     */
    public function paginationItems(string $perPage, string $page): LengthAwarePaginator;
    

}
