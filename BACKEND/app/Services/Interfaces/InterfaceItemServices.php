<?php

namespace App\Services\Interfaces;

use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateDTO;
use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemCreateDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;

interface InterfaceItemServices
{
    /**
     * Servicio para crear un item
     * @param \App\DTOs\ItemDTOs\ItemBasicoCreateRequestDTO $itemCreateDTO
     * DTO para crear el item
     */
    public function create(ItemBasicoCreateRequestDTO $itemBasicoCreateRequestDTO): JsonResponse;
    /**
     * Lista los items en paginación
     */
    public function listItemPagination(): JsonResponse;

    public function createEquipo(EquiposCreateRequestDTO $equiposCreateRequestDTO, array|UploadedFile|null $resource);



}
