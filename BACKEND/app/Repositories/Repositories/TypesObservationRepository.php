<?php

namespace App\Repositories\Repositories;

use App\Models\Inventory\TypesObservation;
use App\Repositories\Interfaces\InterfaceTypesObservationRepository;

class TypesObservationRepository implements InterfaceTypesObservationRepository
{

    /**
     *
     * @param string $typeObservatioId
     * -- ID del tipo de observación a buscar
     * @return bool
     * -- Retorna true si existe, false si no existe
     */
    public function existTypeObservationByTypeObservatioId(string $typeObservatioId): bool
    {
        return TypesObservation::find($typeObservatioId)->exists();
    }
}
