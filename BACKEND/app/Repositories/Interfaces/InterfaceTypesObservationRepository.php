<?php

namespace App\Repositories\Interfaces;

interface InterfaceTypesObservationRepository
{
    public function existTypeObservationByTypeObservatioId(string $typeObservatioId): bool;
}
