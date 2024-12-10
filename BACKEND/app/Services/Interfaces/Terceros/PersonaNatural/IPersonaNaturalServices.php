<?php

namespace App\Services\Interfaces\Terceros\PersonaNatural;

use App\DTOs\Datatable\DatatableDTO;
use App\DTOs\Datatable\RequestDatatableDTO;
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
    /**
     * Maneja la obtención de datos para una interfaz de DataTable.
     *
     * @param RequestDatatableDTO $requestDatatableDTO Objeto que contiene parámetros enviados desde el cliente para paginación, búsqueda y ordenamiento.
     * @return \App\DTOs\Datatable\DatatableDTO Una respuesta estructurada para DataTable que contiene registros y metadatos.
     */
    public function getTercerosTable(RequestDatatableDTO $requestDatatableDTO): DatatableDTO;
    /**
     * Obtiene los detalles de un tercero natural a partir de su correo electrónico.
     *
     * @param string $email
     *     El correo electrónico del tercero natural cuyos detalles se desean obtener.
     *
     * @return \App\DTOs\ResponsesDTO\ResponseDTO
     *     Un objeto de transferencia de datos (`ResponseDTO`) que contiene el mensaje y
     *     los detalles del tercero natural encapsulados en un `PersonaNaturalDTO`.
     */
    public function getDetailsTercero($email);


}
