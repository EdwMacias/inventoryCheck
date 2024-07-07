<?php

namespace App\Repositories\Repositories;

use App\Models\Inventory\Equipo;
use App\Repositories\Interfaces\InterfaceEquipoRespository;

class EquipoRespository implements InterfaceEquipoRespository
{

    /**
     * @inheritDoc
     */
    public function create(array $equipo)
    {
        $equipoModel = new Equipo($equipo);
        return $equipoModel->save();
    }

    /**
     * @inheritDoc
     */
    public function delete(string $equipo_id)
    {
        return Equipo::find($equipo_id)->delete();
    }

    /**
     * @inheritDoc
     */
    public function update(string $equipo_id,array $equipo)
    {
        return Equipo::find($equipo_id)->update($equipo);
    }
}
