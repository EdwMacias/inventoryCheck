<?php

namespace App\Repositories\Interfaces;

interface InterfaceItemBasicoRepository
{
  /**
   * @param array $itemBasico
   * Datos del item basico a crear
   */
  public function create(array $itemBasico, $prefix = null);
  /**
   * Obtiene un registro de Item Básico por su Item ID
   *
   * Este método busca un registro en la tabla `ItemBasico` utilizando el `item_id` proporcionado.
   * Si no encuentra el registro, lanza una excepción con un código de estado HTTP 404.
   * En caso de errores durante la operación, lanza una excepción con un código de estado HTTP 500.
   *
   * @param string $itemId
   *      El identificador único del item a buscar.
   *
   * @return \App\Models\Inventory\ItemBasico
   *      El registro de `ItemBasico` correspondiente al `item_id` proporcionado.
   *
   * @throws \Exception
   *      - Si no se encuentra un registro con el `item_id`, se lanza una excepción con un mensaje
   *        y el código HTTP 404.
   *      - Si ocurre un error durante la búsqueda, se lanza una excepción con un mensaje de error
   *        detallado y el código HTTP 500.
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

  /**
   * Summary of itemBasicoExistBySerialLote
   * @param string $serialLote
   * @return bool
   */
  public function itemBasicoExistBySerialLote(string $serialLote);
}
