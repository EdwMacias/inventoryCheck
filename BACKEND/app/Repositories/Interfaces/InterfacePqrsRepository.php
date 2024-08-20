<?php

namespace App\Repositories\Interfaces;

interface InterfacePqrsRepository
{
    /**
     * Crea un nuevo registro de PQRS.
     *
     * @param array $datos Los datos a insertar en la tabla PQRS.
     * @return \App\Models\Pqrs\Pqrs|\Illuminate\Database\Eloquent\Model El modelo PQRS recién creado.
     */
    public function create(array $datos);
    /**
     * Actualiza un registro de PQRS existente.
     *
     * @param int $pqrsId El identificador único del registro PQRS.
     * @param array $datos Los datos a actualizar en la tabla PQRS.
     * @return bool Indica si la operación de actualización fue exitosa.
     */
    public function update($prqsId, array $datos);
    /**
     * Obtiene todos los registros de la tabla PQRS.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\App\Models\Pqrs\Pqrs[] Colección de todos los registros PQRS.
     */
    public function get();


}
