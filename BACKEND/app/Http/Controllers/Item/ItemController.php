<?php

namespace App\Http\Controllers\Item;

use App\Events\ServerCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        
      
        return;
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
