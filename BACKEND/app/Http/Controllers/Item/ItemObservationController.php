<?php

namespace App\Http\Controllers\Item;

use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Items\Observation\ItemObservationCreateRequest;
use Illuminate\Http\Request;

class ItemObservationController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemObservationCreateRequest $itemObservationCreateRequest)
    {
        $itemObservationDto = ItemObservationDTO::fromArray($itemObservationCreateRequest->toArray());
        // $itemObservationDto->item_id;
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
