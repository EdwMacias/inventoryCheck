<?php

namespace App\Http\Controllers\Item;

use App\DTOs\ItemDTOs\ObservacionesDTOs\ItemBasico\Request\ItemBasicoObservacionRequestDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionEquipoCreateRequestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Items\Observation\Item\Basico\ObservacionItemBasicoRequest;
use App\Http\Requests\Items\Observation\ObservacionEquipoResquestCreate;
use App\Services\Interfaces\InterfaceItemObservationServices;

class ItemObservationController extends Controller
{
    protected InterfaceItemObservationServices $itemObservationServices;

    public function __construct(InterfaceItemObservationServices $interfaceItemObservationServices)
    {
        $this->middleware('auth:api');
        $this->itemObservationServices = $interfaceItemObservationServices;
    }

    /**
     * Summary of createObservacionEquipo
     * @param \App\Http\Requests\Items\Observation\ObservacionEquipoResquestCreate $observacionEquipoResquestCreate
     * @return \Illuminate\Http\JsonResponse
     */
    public function createObservacionEquipo(ObservacionEquipoResquestCreate $observacionEquipoResquestCreate)
    {
        $observacionEquipoCreateDTO = new ObservacionEquipoCreateRequestDTO($observacionEquipoResquestCreate->toArray());
        // $images = $observacionEquipoResquestCreate->file('resource');
        return $this->itemObservationServices->createObservacionEquipo($observacionEquipoCreateDTO);
    }

    public function getObservacionesEquipo($itemId)
    {
        return $this->itemObservationServices->getEquipoObservaciones($itemId);
    }

    public function createObservacionItemBasico(ObservacionItemBasicoRequest $observacionItemBasicoRequest)
    {
        $itemBasicoRequestDTO = new ItemBasicoObservacionRequestDTO($observacionItemBasicoRequest);

        $responseDTO = $this->itemObservationServices->createObservacionItemBasico($itemBasicoRequestDTO);

        return response()->json($responseDTO, $responseDTO->status);
    }
    public function getObservacionItemBasico($id)
    {
        // $itemBasicoRequestDTO = new ItemBasicoObservacionRequestDTO($id);

        $responseDTO = $this->itemObservationServices->getObservacionItemOficinaByItemId($id);

        return response()->json($responseDTO, $responseDTO->status);
    }
}
