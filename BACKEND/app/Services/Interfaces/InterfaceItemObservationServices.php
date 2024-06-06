<?php

namespace App\Services\Interfaces;

use App\DTOs\ItemDTOs\ItemObservationDTO;

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
     * @param string $id
     * id de la observacion a actualizar
     * @param ItemObservationDTO $itemObservationDTO
     * dto con los parametros a actualizar
     */
    public function update(string $id, ItemObservationDTO $itemObservationDTO);
    /**
     *
     * @param string $id
     * id de la observacion a buscar
     */
    public function getObservationById(string $id);
    /**
     *
     * @param string $id
     * id del item a buscar por observaciones
     */
    public function getObservationsByItemId(string $id);

}
