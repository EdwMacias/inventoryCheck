<?php

namespace App\Repositories\Repositories;

use App\Models\Inventory\Equipo;
use App\Repositories\Interfaces\InterfaceEquipoRespository;

class EquipoRespository implements InterfaceEquipoRespository
{

    /**
     * Summary of create
     * @param array $equipo
     * @return bool
     */
    public function create(array $equipo)
    {
        $equipoModel = new Equipo($equipo);
        return $equipoModel->save();
    }

    /**
     * Summary of delete
     * @param string $equipo_id
     * @return bool|mixed|null
     */
    public function delete(string $equipo_id)
    {
        return Equipo::find($equipo_id)->delete();
    }

    /**
     * Summary of update
     * @param string $equipo_id
     * @param array $equipo
     * @return bool|mixed
     */
    public function update(string $equipo_id,array $equipo)
    {
        return Equipo::find($equipo_id)->update($equipo);
    }
    /**
     * Summary of getEquipoByEquipoID
     * @param string $equipo_id
     * @return Equipo|Equipo[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getEquipoByEquipoID(string $equipo_id){
        return Equipo::find($equipo_id);
    }
}
