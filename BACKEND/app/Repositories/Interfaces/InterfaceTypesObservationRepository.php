<?php

namespace App\Repositories\Interfaces;

interface InterfaceTypesObservationRepository
{
    
    /**
     *
     * @param string $typeObservationId
     * -- ID del tipo de observación a buscar
     * @return bool
     * -- Retorna true si existe, false si no existe
     */
    public function existTypeObservationByTypeObservatioId(string $typeObservationId): bool;
}
