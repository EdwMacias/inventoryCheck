<?php

namespace App\Services\Interfaces;

use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDto;

interface InterfaceItemObservationServices
{
    /**
     *
     * @param ItemObservationDTO $itemObservationDTO
     * dto con los datos a crear de la observacion del item
     */
    public function create(ItemObservationDTO $itemObservationDTO);
    /**
     *
     * @param string $observationId
     * id de la observacion a actualizar
     * @param ItemObservationDTO $itemObservationDTO
     * dto con los parametros a actualizar
     */
    public function update(string $observationId, ItemObservationUpdateDto $itemObservationDTO);
    /**
     *
     * @param string $observationId
     * id de la observacion a buscar
     */
    public function getObservationByObservationId(string $observationId);
    /**
     *
     * @param string $itemId
     * id del item a buscar por observaciones
     */
    public function getObservationsByItemId(string $itemId);


}
