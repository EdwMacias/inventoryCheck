<?php

namespace App\Services\Interfaces;
use App\DTOs\PqrsDTOs\Request\PqrsRequestCreateDTO;
use App\DTOs\ResponsesDTO\ResponseDTO;

interface InterfacePqrsServices
{
    /**
     * Crea un nuevo registro de PQRS.
     *
     * @param PqrsRequestCreateDTO $pqrsRequestCreateDTO Objeto DTO que contiene los datos necesarios para crear un PQRS.
     * @return ResponseDTO Objeto DTO que contiene el resultado de la operación.
     */
    public function create(PqrsRequestCreateDTO $pqrsRequestCreateDTO);
    /**
     * Obtiene todos los registros de PQRS y los transforma en DTOs de respuesta.
     *
     * @return ResponseDTO Objeto que contiene un mensaje, los datos transformados, y un código de estado HTTP.
     */
    public function getPqrs(): ResponseDTO;
}
