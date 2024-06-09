<?php

namespace App\Services\Interfaces;

use App\DTOs\ItemDTOs\ItemCreateDTO;
use Illuminate\Http\JsonResponse;

interface InterfaceItemServices
{
    /**
     * Servicio para crear un item
     * @param ItemCreateDTO $itemCreateDTO
     * DTO para crear el item
     * @param mixed $resource
     * recurso del item para crear
     */
    public function create(ItemCreateDTO $itemCreateDTO, $resource): JsonResponse;
    /**
     * Lista los items en paginación
     */
    public function listItemPagination(): JsonResponse;
}
