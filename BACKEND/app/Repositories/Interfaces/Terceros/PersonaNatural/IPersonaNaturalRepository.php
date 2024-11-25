<?php

namespace App\Repositories\Interfaces\Terceros\PersonaNatural;

interface IPersonaNaturalRepository
{
    /**
     * Crea un nuevo registro en la tabla `persona_natural`.
     *
     * Este método recibe un arreglo asociativo con los datos necesarios
     * para crear un registro en la tabla `persona_natural`. Si ocurre un
     * error durante el proceso, lanza una excepción con un mensaje detallado.
     *
     * @param array $datos Los datos para crear un registro en la tabla `persona_natural`.
     * @return \App\Models\Terceros\PersonaNatural\PersonaNatural El modelo recién creado.
     * @throws \Exception Si ocurre un error al crear el registro.
     */
    public function create(array $datos);

    /**
     * Recupera un registro específico de la tabla `persona_natural` por su ID.
     *
     * Este método busca un registro en la tabla `persona_natural` utilizando
     * el ID proporcionado. Si ocurre un error o el registro no existe, lanza
     * una excepción con un mensaje detallado.
     *
     * @param int $id El ID del registro a recuperar.
     * @return \App\Models\Terceros\PersonaNatural\PersonaNatural|null El registro encontrado o `null` si no existe.
     * @throws \Exception Si ocurre un error al recuperar el registro.
     */


    public function getById($id);
    /**
     * Obtiene todos los registros de la tabla `persona_natural`.
     *
     * Este método recupera todos los registros existentes en la tabla
     * `persona_natural`. Si ocurre un error durante la operación, lanza
     * una excepción con un mensaje detallado.
     *
     * @return \Illuminate\Database\Eloquent\Collection Colección de todos los registros.
     * @throws \Exception Si ocurre un error al recuperar los registros.
     */
    public function getAll();
    // public function updateById();

}
