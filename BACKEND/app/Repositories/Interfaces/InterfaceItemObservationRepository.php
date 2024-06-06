<?php

namespace App\Repositories\Interfaces;

use App\DTOs\ItemDTOs\ItemObservationDTO;

interface InterfaceItemObservationRepository
{
     /**
     *
     * @param string $ObservationId
     * id de la observacion a buscar
     * @return bool
     * --Retorna true si existe false si no existe
     */
    public function exitsObservationByObservationId(string $ObservationId);

    /**
     *
     * @param string $ObservationId
     * id de la observacion a buscar
     */
    public function getObservationById(string $ObservationId);
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
     * @param string $ObservationId
     * id de la observacion a actualizar
     * @param ItemObservationDTO $itemObservationDTO
     * datos de la observacion a actualizar
     * @return bool
     */
    public function update(string $ObservationId, ItemObservationDTO $itemObservationDTO): bool;
    /**
     *
     * @param string $ItemId
     * id del item a buscar
     */
    public function getAllObservationByItemId(string $ItemId): array;
}
