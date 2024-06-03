<?php

namespace App\Http\Controllers\Item;

use App\Events\ServerCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\User;
use App\Services\Interfaces\InterfaceItemServices;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function store(ItemRequest $itemCreacionRequest)
    {
        return $this->itemService->create($itemCreacionRequest->toArray(), $itemCreacionRequest->file("resource"));
    }

    /**
     * Display the specified resource.
     */
    public function pagination()
    {
        //
        return $this->itemService->listItemPagination();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $itemRequest, string $id)
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
