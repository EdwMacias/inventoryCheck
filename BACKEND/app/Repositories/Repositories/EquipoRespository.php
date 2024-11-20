<?php

namespace App\Repositories\Repositories;

use App\Models\Inventory\Equipo;
use App\Models\Inventory\EquipoComponentes;
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
    public function update(string $equipo_id, array $equipo)
    {
        return Equipo::find($equipo_id)->update($equipo);
    }
    /**
     * Summary of getEquipoByEquipoID
     * @param string $equipo_id
     * @return Equipo|Equipo[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getEquipoByEquipoID(string $equipo_id)
    {
        return Equipo::find($equipo_id);
    }
    /**
     * Summary of equipoExistByItemID
     * @param string $itemId
     * @return bool
     */
    public function equipoExistByItemID(string $itemId)
    {
        return Equipo::where('item_id', $itemId)->exists();
    }
    /**
     * Recupera un registro del modelo `Equipo` basado en el `item_id` proporcionado.
     *
     * Este método busca en la tabla `Equipo` un registro donde el `item_id` coincida con el `$itemId`
     * proporcionado y devuelve el primer resultado encontrado.
     * 
     * @param string $itemId El ID del ítem para buscar el equipo.
     * 
     * @return Equipo|object|\Illuminate\Database\Eloquent\Model|null El modelo `Equipo` encontrado,
     * un objeto genérico, o `null` si no se encuentra ningún registro.
     */
    public function getEquipoByItemID(string $itemId)
    {
        return Equipo::where('item_id', $itemId)->first();
    }

    public function equipoExistBySerialLote(string $serialLote)
    {
        return Equipo::where('serie_lote', $serialLote)->exists();
    }

    /**
     * @inheritDoc
     */
    public function createComponentesEquipo(array $datos)
    {
        $now = now(); // Obtén la fecha y hora actual
        $datos = array_map(function ($registro) use ($now) {
            if (is_array($registro)) {
                $registro['created_at'] = $now;
                $registro['updated_at'] = $now;
            } 
            return $registro;
        }, $datos);
        return EquipoComponentes::insert($datos);
    }
   
}
