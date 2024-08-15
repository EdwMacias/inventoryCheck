<?php

namespace App\Repositories\Interfaces;

interface InterfaceEquipoRespository
{
    /**
     * Summary of create
     * @param array $equipo
     * @return bool
     */
    public function create(array $equipo);
    /**
     * Summary of update
     * @param string $equipo_id
     * @param array $equipo
     * @return bool|mixed
     */
    public function update(string $equipo_id, array $equipo);
    /**
     * Summary of delete
     * @param string $equipo_id
     * @return bool|mixed|null
     */
    public function delete(string $equipo_id);
    /**
     * Summary of getEquipoByEquipoID
     * @param string $equipo_id
     * @return \App\Models\Inventory\Equipo|\App\Models\Inventory\Equipo[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getEquipoByEquipoID(string $equipo_id);

}
