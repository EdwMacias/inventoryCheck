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
    /**
     * Verifica la existencia de una persona natural por su número de identificación.
     *
     * Este método realiza una consulta en la base de datos para verificar si existe
     * una persona natural con el número de identificación proporcionado.
     *
     * @param string $numberIdentification Número de identificación de la persona natural a buscar.
     * 
     * @return bool Retorna `true` si existe una persona natural con el número de identificación, `false` en caso contrario.
     * 
     * @throws \Exception Si ocurre un error durante la consulta, lanza una excepción con un mensaje de error detallado y el código HTTP 500.
     */
    public function existByNumberIdentification(string $numberIdentification);
    /**
     * Verifica la existencia de un registro por correo electrónico.
     *
     * Este método consulta si existe un registro en la tabla `PersonaNatural`
     * que coincida con el correo electrónico proporcionado.
     *
     * @param string $email El correo electrónico que se desea verificar.
     *
     * @return bool Devuelve `true` si existe un registro con el correo proporcionado, `false` de lo contrario.
     *
     * @throws \Exception Lanza una excepción en caso de error al realizar la consulta,
     * con un mensaje descriptivo y un código de estado HTTP 500.
     */
    public function existByEmail(string $email);

}
