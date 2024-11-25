<?php

namespace App\Services\Interfaces\Terceros\PersonaNatural;

use App\DTOs\Terceros\Tercero\PersonaNatural\PersonaNaturalCreateDTO;

interface IPersonaNaturalServices
{
    /**
     * Crea una nueva Persona Natural
     *
     * Este método registra una nueva persona natural en el sistema utilizando los datos
     * proporcionados en el DTO de creación. Los datos se guardan en el repositorio
     * correspondiente y se retorna un DTO de respuesta con los datos registrados.
     *
     * @param \App\DTOs\Terceros\Tercero\PersonaNatural\PersonaNaturalCreateDTO $personaNaturalCreateDTO
     * @return \App\DTOs\ResponsesDTO\ResponseDTO Objeto de respuesta con el mensaje y los datos de la persona natural registrada
     */
    public function create(PersonaNaturalCreateDTO $personaNaturalCreateDTO);
    /**
     * Obtiene los datos de una Persona Natural por ID
     *
     * Este método busca una persona natural en el repositorio a partir de su ID. Si se encuentra,
     * los datos se transforman en un DTO y se retornan junto con un mensaje de éxito.
     *
     * @param string $personaNaturalId ID de la persona natural a consultar
     * @return \App\DTOs\ResponsesDTO\ResponseDTO Objeto de respuesta con el mensaje y los datos de la persona natural consultada
     */
    public function showById(string $personaNaturalId);

}
