<?php

namespace App\Repositories\Repositories;

use App\DTOs\ItemDTOs\ItemObservationDTO;
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
     * @param string $ItemId
     * id del item a buscar
     */
    public function getAllObservationByItemId(string $ItemId): array
    {
        return ItemObservation::where('item_id', $ItemId)->toArray();
    }
    /**
     *
     * @param string $ObservationId
     * id de la observacion a buscar
     */
    public function getObservationById(string $ObservationId)
    {
        return ItemObservation::find($ObservationId);
    }

    /**
     *
     * @param string $ObservationId
     * id de la observacion a actualizar
     * @param ItemObservationDTO $itemObservationDTO
     * datos de la observacion a actualizar
     * @return bool
     */
    public function update(string $ObservationId, ItemObservationDTO $itemUpdateObservationDTO): bool
    {
        $itemObservation = ItemObservation::find($ObservationId);
        $itemObservation->observation = $itemUpdateObservationDTO->observation;
        return $itemObservation->save();
    }
    /**
     *
     * @param string $ObservationId id de la observacion a buscar
     * @return bool --Retorna true si existe false si no existe
     */
    public function exitsObservationByObservationId(string $ObservationId)
    {
        return ItemObservation::find($ObservationId)->exists();
    }
}
