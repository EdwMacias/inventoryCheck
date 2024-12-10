<?php

namespace App\Repositories\Interfaces\Terceros\PersonaJuridica;

interface IPersonaJuridicaRepository
{
    /**
     * Crea una nueva Persona Jurídica en la base de datos.
     *
     * @param array $datos
     *   Array asociativo con los datos necesarios para crear la Persona Jurídica.
     *   Ejemplo:
     *   [
     *       'nombre' => 'Empresa S.A.S',
     *       'email' => 'contacto@empresa.com',
     *       'nit' => '123456789-0',
     *       'direccion' => 'Calle 123 #45-67',
     *       ...
     *   ]
     *
     * @return \App\Models\Terceros\PersonaJuridica\PersonaJuridica
     *   La instancia del modelo recién creada.
     *
     * @throws \Exception
     *   Lanza una excepción si ocurre un error al crear la Persona Jurídica.
     */
    public function create(array $datos);
    /**
     * Verifica si existe una Persona Jurídica con un email dado.
     *
     * @param string $email
     *   El email a buscar.
     *
     * @return bool
     *   Devuelve `true` si existe una Persona Jurídica con el email dado, de lo contrario `false`.
     *
     * @throws \Exception
     *   Lanza una excepción si ocurre un error durante la consulta.
     */
    public function existByEmail(string $email);
    /**
     * Verifica si existe una Persona Jurídica con un NIT dado.
     *
     * @param string $nit
     *   El NIT a buscar.
     *
     * @return bool
     *   Devuelve `true` si existe una Persona Jurídica con el NIT dado, de lo contrario `false`.
     *
     * @throws \Exception
     *   Lanza una excepción si ocurre un error durante la consulta.
     */
    public function existByNit(string $nit);

    /**
     * Obtiene los datos de un tercero jurídico basado en su correo electrónico.
     *
     * @param string $email
     *     El correo electrónico del tercero jurídico que se busca.
     *
     * @return \App\Models\Terceros\PersonaJuridica\PersonaJuridica
     *     Instancia del modelo `PersonaJuridica` correspondiente al correo electrónico proporcionado.
     *
     * @throws \Exception
     *     - Si no se encuentra un tercero jurídico con el correo electrónico especificado, se lanza una excepción
     *       con un mensaje y un código de estado HTTP 404.
     *     - Si ocurre algún otro error durante la ejecución, se lanza una excepción con un mensaje detallado
     *       y un código de estado HTTP 500.
     */
    public function getTerceroByEmail($email);

}
