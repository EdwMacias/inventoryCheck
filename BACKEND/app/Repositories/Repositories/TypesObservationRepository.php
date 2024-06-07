<?php

namespace App\Repositories\Repositories;

use App\Models\Inventory\TypesObservation;
use App\Repositories\Interfaces\InterfaceTypesObservationRepository;

class TypesObservationRepository implements InterfaceTypesObservationRepository
{

    /**
     *
     * @param string $typeObservationId
     * -- ID del tipo de observación a buscar
     * @return bool
     * -- Retorna true si existe, false si no existe
     */
    public function existTypeObservationByTypeObservatioId(string $typeObservationId): bool
    {
        return TypesObservation::where('types_observation_id', $typeObservationId)->exists();
    }
}
