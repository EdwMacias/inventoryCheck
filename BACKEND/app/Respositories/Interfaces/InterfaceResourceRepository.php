<?php

namespace App\Respositories\Interfaces;

interface InterfaceResourceRepository
{
    /**
     *
     * @param array $resource
     * @return bool
     */
    public function create(array $resource): bool;
    // public function create(array $resource);
}
