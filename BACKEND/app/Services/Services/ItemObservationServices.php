<?php

namespace App\Services\Services;

use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\Repositories\Interfaces\InterfaceItemObservationRepository;
use App\Repositories\Interfaces\InterfaceItemRepository;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;
use App\Services\Interfaces\InterfaceItemObservationServices;

class ItemObservationServices implements InterfaceItemObservationServices
{

    protected InterfaceUsuarioRepository $usuarioRepository;
    protected InterfaceItemRepository $itemRepository;
    protected InterfaceItemObservationRepository $itemObservationRepository;

    public function __construct(
        InterfaceItemObservationRepository $interfaceItemObservationRepository,
        InterfaceItemRepository $interfaceItemRepository,
        InterfaceUsuarioRepository $interfaceUsuarioRepository
    ) {
        $this->usuarioRepository = $interfaceUsuarioRepository;
        $this->itemRepository = $interfaceItemRepository;
        $this->itemObservationRepository = $interfaceItemObservationRepository;
    }

    /**
     *
     * @param ItemObservationDTO $itemObservationDTO
     * dto con los datos a crear de la observacion del item
     */
    public function create(ItemObservationDTO $itemObservationDTO)
    {


    }

    /**
     *
     * @param string $id
     * id de la observacion a buscar
     */
    public function getObservationById(string $id)
    {
    }

    /**
     *
     * @param string $id
     * id del item a buscar por observaciones
     */
    public function getObservationsByItemId(string $id)
    {
    }

    /**
     *
     * @param string $id
     * id de la observacion a actualizar
     * @param ItemObservationDTO $itemObservationDTO
     * dto con los parametros a actualizar
     */
    public function update(string $id, ItemObservationDTO $itemObservationDTO)
    {
    }
}
