<?php

namespace App\Repositories\Interfaces;

use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDTO;
use App\Models\Inventory\ItemObservation;

interface InterfaceItemObservationRepository
{
    /**
     *
     * @param string $observationId
     * id de la observacion a buscar
     * @return bool
     * --Retorna true si existe false si no existe
     */
    public function exitsObservationByObservationId(string $observationId);

    /**
     *
     * @param string $observationId
     * id de la observacion a buscar
     * @return ItemObservation
     */
    public function getObservationByObservationId(string $observationId): ItemObservation;
    /**
     * Crea una nueva observación de ítem.
     * 
     * Este método recibe un array de datos y utiliza el modelo `ItemObservation`
     * para crear una nueva entrada en la base de datos con dichos datos.
     *
     * @param array $datos Los datos necesarios para crear una nueva observación de ítem.
     * @return ItemObservation|\Illuminate\Database\Eloquent\Model La instancia del modelo 
     * `ItemObservation` recién creada o una instancia del modelo de Eloquent.
     */
    public function create(array $datos);
    /**
     *
     * @param string $observationId
     * id de la observacion a actualizar
     * @param ItemObservationDTO $itemObservationDTO
     * datos de la observacion a actualizar
     * @return bool
     */
    public function update(string $observationId, ItemObservationUpdateDTO $itemObservationDTO): bool;
    /**
     *
     * @param string $itemId
     * id del item a buscar
     */
    public function getAllObservationByItemId(string $itemId): array;
    /**
     * Summary of createObservacionEquipo
     * @param array $observacionEquipo
     * @return \App\Models\Inventory\Observaciones\EquipoObservacion|\Illuminate\Database\Eloquent\Model
     */
    public function createObservacionEquipo(array $observacionEquipo);
    /**
     * Recupera un constructor de consultas para el modelo `EquipoObservacion`, filtrado por `equipo_id`.
     *
     * Este método construye una consulta para seleccionar registros de la tabla `EquipoObservacion`
     * donde el `equipo_id` coincide con el `$equipoId` proporcionado.
     * 
     * @param int|string $equipoId El ID del equipo para filtrar las observaciones.
     * @param array|null $campos (opcional) Un arreglo de columnas específicas a seleccionar.
     * 
     * @return  \Illuminate\Database\Eloquent\Builder constructor de consultas para personalización adicional.
     */
    public function getTableEquipoObservacionByEquipoId($equipoId);
    public function getTableOficinaObservacionByItemBasicoId($itemBasicoId);
}
