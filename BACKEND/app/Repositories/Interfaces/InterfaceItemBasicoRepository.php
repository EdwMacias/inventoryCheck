<?php

namespace App\Repositories\Interfaces;

interface InterfaceItemBasicoRepository
{
    /**
     * @param array $itemBasico
     * Datos del item basico a crear
     */
    public function create(array $itemBasico);
}
