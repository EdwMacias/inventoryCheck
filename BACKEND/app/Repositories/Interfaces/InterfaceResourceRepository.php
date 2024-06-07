<?php

namespace App\Repositories\Interfaces;
use App\DTOs\ResourceDTOs\ResourceDTO;

interface InterfaceResourceRepository
{
    /**
     *
     * @param ResourceDTO $resource
     * @return bool
     */
    public function create(ResourceDTO $resource): bool;
    // public function create(array $resource);
}
