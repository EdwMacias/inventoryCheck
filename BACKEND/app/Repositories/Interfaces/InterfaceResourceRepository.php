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
      /**
     * Summary of createRecords
     * @param array $resources
     * @return bool
     */
    public function createRecords(array $resources);
}
