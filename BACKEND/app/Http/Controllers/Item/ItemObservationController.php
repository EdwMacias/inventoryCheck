<?php

namespace App\Http\Controllers\Item;

use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Items\Observation\ItemObservationCreateRequest;
use App\Http\Requests\Items\Observation\ItemObservationUpdateRequest;
use App\Services\Interfaces\InterfaceItemObservationServices;
use App\Utils\ResponseHandler;
use Illuminate\Http\Request;

class ItemObservationController extends Controller
{
    protected InterfaceItemObservationServices $itemObservationServices;

    public function __construct(InterfaceItemObservationServices $interfaceItemObservationServices)
    {
        $this->middleware('auth:api');
        $this->itemObservationServices = $interfaceItemObservationServices;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemObservationCreateRequest $itemObservationCreateRequest)
    {
        $responseHandle = new ResponseHandler();
        $resource = $itemObservationCreateRequest->file('resource');
        
        if (sizeof($resource) > 5) {
            return $responseHandle->setStatus(500)->setData(["error" => "Solo se acepta un maximo de cinco imagenes"])->setMessages("Error")->responses();
        }

        $itemObservationDto = ItemObservationDTO::fromArray($itemObservationCreateRequest->toArray());
        return $this->itemObservationServices->create($itemObservationDto, $resource);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemObservationUpdateRequest $itemObservationUpdateRequest, string $id)
    {
        //
        $itemObservationUpdateDto = ItemObservationUpdateDTO::fromArray($itemObservationUpdateRequest->toArray());
        return $this->itemObservationServices->update($id, $itemObservationUpdateDto);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
