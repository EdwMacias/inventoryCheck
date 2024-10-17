<?php

namespace App\Repositories\Repositories;

use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDTO;
use App\Models\Inventory\ItemBasico;
use App\Models\Inventory\ItemObservation;
use App\Models\Inventory\Observaciones\EquipoObservacion;
use App\Models\Inventory\Observaciones\ItemBasicoObservacion;
use App\Repositories\Interfaces\InterfaceItemObservationRepository;
use Symfony\Component\HttpFoundation\Response;

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

    public function getItemBasicoId($itemId)
    {
        try {
            // Obtener el primer registro que coincida con el item_id y devolver solo el campo item_basico_id
            $itemBasico = ItemBasico::where("item_id", $itemId)->get('item_basico_id')->first();

            if (!$itemBasico) {
                # code... 
                throw new \Exception("No sé encontro el item", Response::HTTP_NOT_FOUND);

            }
            return $itemBasico;
            // Retorna el item_basico_id o null si no se encuentra

        } catch (\Exception $e) {
            // Lanza una excepción en caso de error durante la consulta
            throw new \Exception("Error al buscar el item básico: {$e->getMessage()}", Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

}
