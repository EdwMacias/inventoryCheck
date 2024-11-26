<?php

namespace App\Services\Interfaces\Terceros\PersonaJuridica;

use App\DTOs\Terceros\Tercero\PersonaJuridica\PersonaJuridicaCreateDTO;

interface IPersonaJuridicaService
{
    /**
     * Crea una nueva Persona Jurídica verificando que no existan registros previos con el mismo email o NIT.
     *
     * @param PersonaJuridicaCreateDTO $personaJuridicaCreateDTO
     *   Objeto de transferencia de datos (DTO) que contiene la información necesaria para crear una Persona Jurídica.
     *   Ejemplo:
     *   {
     *       "nombre": "Empresa S.A.S",
     *       "email": "contacto@empresa.com",
     *       "nit": "123456789-0",
     *       "direccion": "Calle 123 #45-67",
     *       ...
     *   }
     *
     * @return \App\DTOs\ResponsesDTO\ResponseDTO
     *   Un objeto de transferencia de respuesta que contiene el mensaje, los datos, y el código de estado HTTP:
     *   - En caso de conflicto (HTTP 409):
     *     Mensaje: "Email ya se encuentra registrado" o "NIT ya se encuentra registrado".
     *     Datos: Los datos originales enviados en el DTO.
     *   - En caso de éxito (HTTP 201):
     *     Mensaje: "Persona Juridica Creada Satisfactoriamente".
     *     Datos: Un objeto `PersonaJuridicaDTO` con la información de la Persona Jurídica creada.
     *
     * @throws \Exception
     *   Lanza una excepción si ocurre un error durante la creación de la Persona Jurídica.
     */
    public function create(PersonaJuridicaCreateDTO $personaJuridicaCreateDTO);

}
