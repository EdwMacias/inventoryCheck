<?php

namespace App\Http\Controllers\Item;

use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateRequestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\Items\Equipo\EquipoRequest;
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
        $this->middleware('auth:api');
    }

    /**
     * Crea un item
     * @param ItemRequest $itemCreacionRequest
     * request de creacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ItemRequest $itemCreacionRequest)
    {
        $itemCreateDto = new ItemBasicoCreateRequestDTO($itemCreacionRequest->all());
        return $this->itemService->create($itemCreateDto, $itemCreacionRequest->file("resource"));
    }

    /**
     * Pagina los items
     * perpage determina los items a mostrar
     * page la pagina que va a renderizar
     */
    public function pagination()
    {
        // return []
        return $this->itemService->listItemPagination();
    }

    public function createEquipo(EquipoRequest $equipoRequest)
    {
        $equipoRequest->merge([
            'cond_electrica' => filter_var($equipoRequest->input('cond_electrica'), FILTER_VALIDATE_BOOLEAN),
            'cond_mecanica' => filter_var($equipoRequest->input('cond_mecanica'), FILTER_VALIDATE_BOOLEAN),
            'cond_ambientales' => filter_var($equipoRequest->input('cond_ambientales'), FILTER_VALIDATE_BOOLEAN),
            'cond_seguridad' => filter_var($equipoRequest->input('cond_seguridad'), FILTER_VALIDATE_BOOLEAN),
            'cond_transporte' => filter_var($equipoRequest->input('cond_transporte'), FILTER_VALIDATE_BOOLEAN),
            'cond_otras' => filter_var($equipoRequest->input('cond_otras'), FILTER_VALIDATE_BOOLEAN),
        ]);

        $equipoRequest->validate([
            'cond_electrica' => 'required|bool',
            'cond_mecanica' => 'required|bool',
            'cond_ambientales' => 'required|bool',
            'cond_seguridad' => 'required|bool',
            'cond_transporte' => 'required|bool',
            'cond_otras' => 'required|bool',
        ]);

        $equipoCreateRequestDTO = EquiposCreateRequestDTO::fromArray($equipoRequest->all());
        return $this->itemService->createEquipo($equipoCreateRequestDTO, $equipoRequest->file("resource"));
    }
}
