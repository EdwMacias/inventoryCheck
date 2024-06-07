<?php

namespace App\Services\Interfaces;

use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDTO;
use Illuminate\Http\UploadedFile;

interface InterfaceItemObservationServices
{
    /**
     *
     * @param ItemObservationDTO $itemObservationDTO
     * dto con los datos a crear de la observacion del item
     * @param array $resources
     */
    public function create(ItemObservationDTO $itemObservationDTO, array $resources);
    /**
     *
     * @param string $observationId
     * id de la observacion a actualizar
     * @param ItemObservationDTO $itemObservationDTO
     * dto con los parametros a actualizar
     */
    public function update(string $observationId, ItemObservationUpdateDTO $itemObservationDTO);
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
