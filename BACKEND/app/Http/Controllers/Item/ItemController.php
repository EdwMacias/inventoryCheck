<?php

namespace App\Http\Controllers\Item;

use App\DTOs\ItemDTOs\ItemCreateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Services\Interfaces\InterfaceItemServices;


class ItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    protected InterfaceItemServices $itemService;

    public function __construct(InterfaceItemServices $interfaceItemServices)
    {
        $this->itemService = $interfaceItemServices;
    }

    /**
     * Crea un item
     * @param ItemRequest $itemCreacionRequest
     * request de creacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ItemRequest $itemCreacionRequest)
    {
        $itemCreateDto = ItemCreateDTO::fromArray($itemCreacionRequest->all());
        return $this->itemService->create($itemCreateDto, $itemCreacionRequest->file("resource"));
    }

    /**
     * Pagina los items
     * perpage determina los items a mostrar
     * page la pagina que va a renderizar
     */
    public function pagination()
    {
        return $this->itemService->listItemPagination();
    }
}
