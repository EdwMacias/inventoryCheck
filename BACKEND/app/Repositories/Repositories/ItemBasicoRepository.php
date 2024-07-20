<?php

namespace App\Repositories\Repositories;
use App\Models\Inventory\ItemBasico;
use App\Repositories\Interfaces\InterfaceItemBasicoRepository;

class ItemBasicoRepository implements InterfaceItemBasicoRepository
{
    
    /**
     * @param array $itemBasico
     * Datos del item basico a crear
     */
    public function create(array $itemBasico) {
        $itemBasico = new ItemBasico($itemBasico);
        return $itemBasico->save();
    }
}
