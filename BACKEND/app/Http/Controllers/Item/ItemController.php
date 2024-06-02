<?php

namespace App\Http\Controllers\Item;

use App\Events\ServerCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $itemCreacionRequest)
    {
        try {
            //code...
            $imagen = $itemCreacionRequest->file('resource');
            $ruta = $imagen->store('imagenes', 'public');
            $url = asset('storage/' . $ruta);
            return response()->json(['url' => $url], 200);

        } catch (\Throwable $th) {
            return $th->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }

        // return;
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
