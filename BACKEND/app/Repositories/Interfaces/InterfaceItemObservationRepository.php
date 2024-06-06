<?php

namespace App\Repositories\Interfaces;

use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDto;
use App\Models\Inventory\ItemObservation;

interface InterfaceItemObservationRepository
{
     /**
     *
     * @param string $observationId
     * id de la observacion a buscar
     * @return bool
     * --Retorna true si existe false si no existe
     */
    public function exitsObservationByObservationId(string $observationId);

    /**
     *
     * @param string $observationId
     * id de la observacion a buscar
     * @return ItemObservation
     */
    public function getObservationByObservationId(string $observationId) : ItemObservation;
    /**
     *
     * @param \App\DTOs\ItemDTOs\ItemObservationDTO $itemObservationDTO
     * datos para crear el item
     * @return bool
     * la respuesta seran: 
     *  true : creo,
     *  false : no creo
     */
    public function create(ItemObservationDTO $itemObservationDTO): bool;
    /**
     *
     * @param string $observationId
     * id de la observacion a actualizar
     * @param ItemObservationDTO $itemObservationDTO
     * datos de la observacion a actualizar
     * @return bool
     */
    public function update(string $observationId, ItemObservationUpdateDto $itemObservationDTO): bool;
    /**
     *
     * @param string $itemId
     * id del item a buscar
     */
    public function getAllObservationByItemId(string $itemId): array;
}
