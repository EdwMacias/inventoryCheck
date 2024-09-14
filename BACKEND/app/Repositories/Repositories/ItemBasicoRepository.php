<?php

namespace App\Repositories\Repositories;
use App\Models\Inventory\ItemBasico;
use App\Models\Inventory\Observaciones\ItemBasicoObservacion;
use App\Repositories\Interfaces\InterfaceItemBasicoRepository;
use Illuminate\Database\Eloquent\Model;

class ItemBasicoRepository implements InterfaceItemBasicoRepository
{

    /**
     * @param array $itemBasico
     * Datos del item basico a crear
     */
    public function create(array $itemBasico)
    {
        $itemBasico = new ItemBasico($itemBasico);
        return $itemBasico->save();
    }

    public function getItemBasicoByItemId(string $itemId)
    {
        return ItemBasico::where('item_id', $itemId)->first();
    }
    /**
     * Resumen de createObservacion
     *
     * Este método crea un nuevo registro en la tabla `ItemBasicoObservacion` utilizando los datos proporcionados en el arreglo `$datos`.
     *
     * @param array $datos Un arreglo asociativo que contiene los datos necesarios para crear una nueva observación.
     * 
     * @return ItemBasicoObservacion|\Illuminate\Database\Eloquent\Model 
     * Devuelve una instancia del modelo `ItemBasicoObservacion` recién creada.
     * El tipo de retorno puede ser:
     * - `\App\Models\Inventory\ItemBasicoObservacion`: La observación recién creada.
     * - `\Illuminate\Database\Eloquent\Model`: El modelo base de Eloquent que contiene el nuevo registro.
     */
    public function createObservacion(array $datos)
    {
        return ItemBasicoObservacion::create($datos);
    }

    public function itemBasicoExistBySerialLote(string $serialLote)
    {
        return ItemBasico::where('serie_lote', $serialLote)->exists();
    }
}
