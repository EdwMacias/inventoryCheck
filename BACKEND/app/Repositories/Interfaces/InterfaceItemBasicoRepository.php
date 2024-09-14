<?php

namespace App\Repositories\Interfaces;

interface InterfaceItemBasicoRepository
{
    /**
     * @param array $itemBasico
     * Datos del item basico a crear
     */
    public function create(array $itemBasico);
       /**
     * Resumen de getItemBasicoByItemId
     *
     * Este método busca y recupera un registro de la tabla `ItemBasico` que coincida con el valor proporcionado de `itemId`.
     *
     * @param string $itemId El identificador único del item que se desea buscar.
     * 
     * @return \App\Models\Inventory\ItemBasico|\Illuminate\Database\Eloquent\Model|object|null 
     * Devuelve una instancia de `ItemBasico` si se encuentra un registro con el `item_id` especificado.
     * En caso contrario, devuelve `null`. El tipo de retorno puede ser:
     * - `\App\Models\Inventory\ItemBasico`: El modelo `ItemBasico` si se encuentra un registro.
     * - `\Illuminate\Database\Eloquent\Model`: Cualquier otro modelo que sea retornado por la consulta.
     * - `object`: En algunos casos, podría retornar un objeto genérico.
     * - `null`: Si no se encuentra ningún registro que coincida con el `item_id`.
     */
    public function getItemBasicoByItemId(string $itemId);
    /**
     * Resumen de createObservacion
     *
     * Este método crea un nuevo registro en la tabla `ItemBasicoObservacion` utilizando los datos proporcionados en el arreglo `$datos`.
     *
     * @param array $datos Un arreglo asociativo que contiene los datos necesarios para crear una nueva observación.
     * 
     * @return \App\Models\Inventory\Observaciones\ItemBasicoObservacion|\Illuminate\Database\Eloquent\Model 
     * Devuelve una instancia del modelo `ItemBasicoObservacion` recién creada.
     * El tipo de retorno puede ser:
     * - `\App\Models\Inventory\ItemBasicoObservacion`: La observación recién creada.
     * - `\Illuminate\Database\Eloquent\Model`: El modelo base de Eloquent que contiene el nuevo registro.
     */
    public function createObservacion(array $datos);
}
