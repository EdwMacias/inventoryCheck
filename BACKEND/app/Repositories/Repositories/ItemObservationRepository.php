<?php

namespace App\Repositories\Repositories;

use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDTO;
use App\Models\Inventory\ItemObservation;
use App\Repositories\Interfaces\InterfaceItemObservationRepository;

class ItemObservationRepository implements InterfaceItemObservationRepository
{
    /**
     *
     * @param \App\DTOs\ItemDTOs\ItemObservationDTO $itemObservationDTO
     * datos para crear el item
     * @return bool
     * la respuesta seran: 
     *  true : creo,
     *  false : no creo
     */
    public function create(ItemObservationDTO $itemCreateObservationDTO): bool
    {
        $observationItem = new ItemObservation($itemCreateObservationDTO->toArray());
        return $observationItem->save();
    }

    /**
     *
     * @param string $itemId
     * id del item a buscar
     */
    public function getAllObservationByItemId(string $itemId): array
    {
        return ItemObservation::where('item_id', $itemId)->toArray();
    }
    /**
     *
     * @param string $observationId
     * id de la observacion a buscar
     * @return ItemObservation
     */
    public function getObservationByObservationId(string $observationId) : ItemObservation
    {
        return ItemObservation::find($observationId);
    }

    /**
     *
     * @param string $observationId
     * id de la observacion a actualizar
     * @param ItemObservationDTO $itemObservationDTO
     * datos de la observacion a actualizar
     * @return bool
     */
    public function update(string $observationId, ItemObservationUpdateDTO $itemUpdateObservationDTO): bool
    {
        $itemObservation = ItemObservation::find($observationId);
        $itemObservation->observation = $itemUpdateObservationDTO->observation;
        return $itemObservation->save();
    }
    /**
     *
     * @param string $observationId id de la observacion a buscar
     * @return bool --Retorna true si existe false si no existe
     */
    public function exitsObservationByObservationId(string $observationId)
    {
        return ItemObservation::find($observationId)->exists();
    }
}
