<?php

namespace App\Repositories\Repositories;

use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDTO;
use App\Models\Inventory\ItemObservation;
use App\Models\Inventory\Observaciones\EquipoObservacion;
use App\Repositories\Interfaces\InterfaceItemObservationRepository;

class ItemObservationRepository implements InterfaceItemObservationRepository
{

    public function create(array $datos)
    {
        return ItemObservation::create($datos);
    }

    /**
     *
     * @param string $itemId
     * id del item a buscar
     */
    public function getAllObservationByItemId(string $itemId): array
    {
        return ItemObservation::where('item_id', $itemId)->toArray();
    }
    /**
     *
     * @param string $observationId
     * id de la observacion a buscar
     * @return ItemObservation
     */
    public function getObservationByObservationId(string $observationId): ItemObservation
    {
        return ItemObservation::find($observationId);
    }

    /**
     *
     * @param string $observationId
     * id de la observacion a actualizar
     * @param ItemObservationDTO $itemObservationDTO
     * datos de la observacion a actualizar
     * @return bool
     */
    public function update(string $observationId, ItemObservationUpdateDTO $itemUpdateObservationDTO): bool
    {
        $itemObservation = ItemObservation::find($observationId);
        $itemObservation->observation = $itemUpdateObservationDTO->observation;
        return $itemObservation->save();
    }
    /**
     *
     * @param string $observationId id de la observacion a buscar
     * @return bool --Retorna true si existe false si no existe
     */
    public function exitsObservationByObservationId(string $observationId)
    {
        return ItemObservation::find($observationId)->exists();
    }
    /**
     * Summary of createObservacionEquipo
     * @param array $observacionEquipo
     * @return EquipoObservacion|\Illuminate\Database\Eloquent\Model
     */
    public function createObservacionEquipo(array $observacionEquipo)
    {
        return EquipoObservacion::create($observacionEquipo);
    }

    public function getTableEquipoObservacionByEquipoId($equipoId, $campos = null)
    {
        return EquipoObservacion::with(["equipo"])->where("equipo_id", $equipoId);
    }
}
