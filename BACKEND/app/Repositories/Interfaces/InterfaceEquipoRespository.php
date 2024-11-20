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
    /**
     * Summary of equipoExistByItemID
     * @param string $itemId
     * @return bool
     */
    public function equipoExistByItemID(string $itemId);
    /**
     * Recupera un registro del modelo `Equipo` basado en el `item_id` proporcionado.
     *
     * Este método busca en la tabla `Equipo` un registro donde el `item_id` coincida con el `$itemId`
     * proporcionado y devuelve el primer resultado encontrado.
     * 
     * @param string $itemId El ID del ítem para buscar el equipo.
     * 
     * @return \App\Models\Inventory\Equipo|object|\Illuminate\Database\Eloquent\Model|null El modelo `Equipo` encontrado,
     * un objeto genérico, o `null` si no se encuentra ningún registro.
     */
    public function getEquipoByItemID(string $itemId);
    /**
     * Summary of equipoExistBySerialLote
     * @param string $serialLote
     * @return bool
     */
    public function equipoExistBySerialLote(string $serialLote);

    public function createComponentesEquipo(array $datos);

}
