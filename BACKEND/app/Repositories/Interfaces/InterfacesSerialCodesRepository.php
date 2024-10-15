<?php

namespace App\Repositories\Interfaces;

interface InterfacesSerialCodesRepository
{
    /**
     * Verifica si un código de serial existe en la base de datos.
     *
     * Este método busca en la tabla `serial_codes` si existe un registro cuyo campo `codigo`
     * coincida con el código proporcionado. En caso de error durante la consulta, se captura
     * la excepción y se lanza una nueva excepción personalizada con un mensaje más detallado.
     *
     * @param string $code El código del serial que se quiere verificar.
     * 
     * @throws \Exception Si ocurre un error durante la consulta de la base de datos.
     * 
     * @return bool Devuelve `true` si el código de serial existe, o `false` en caso contrario.
     */
    public function codeExistByCode(string $code);

    
    // public function generateAutoIncrementCode(string $prefix, string $id): string;
}
