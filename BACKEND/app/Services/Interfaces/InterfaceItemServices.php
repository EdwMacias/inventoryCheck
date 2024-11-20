<?php

namespace App\Services\Interfaces;

use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateDTO;
use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemCreateDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ComponenteEquipoDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;

interface InterfaceItemServices
{
    /**
     * Servicio para crear un item
     * @param \App\DTOs\ItemDTOs\ItemBasicoCreateRequestDTO $itemCreateDTO
     * DTO para crear el item
     */
    public function create(ItemBasicoCreateRequestDTO $itemBasicoCreateRequestDTO): JsonResponse;
    /**
     * Lista los items en paginación
     */
    public function listItemPagination(): JsonResponse;

    public function createEquipo(EquiposCreateRequestDTO $equiposCreateRequestDTO, array|UploadedFile|null $resource);
    /**
     * Agrega componentes de equipo a un equipo específico.
     *
     * Esta función valida la existencia del equipo mediante su `$id`, verifica que los tipos de 
     * componentes sean válidos y, si todo es correcto, registra los componentes en la base de datos.
     * Si algún tipo de componente no es válido, o si el equipo no existe, devuelve una respuesta con
     * el mensaje de error correspondiente.
     *
     * @param mixed $id ID del equipo al cual se le agregarán los componentes.
     * @param array $componenteEquipoDTOs Lista de objetos DTO de componentes del equipo, 
     * cada uno de los cuales contiene propiedades como `type` y `itemId`.
     * 
     * @return \App\DTOs\ResponsesDTO\ResponseDTO
     * Retorna un objeto `ResponseDTO` con:
     *  - Mensaje de éxito o error.
     *  - Los datos de los componentes agregados o `null` en caso de error.
     *  - Código de estado HTTP que representa el resultado de la operación.
     *      - `HTTP_CREATED` (201) si la operación fue exitosa.
     *      - `HTTP_NOT_FOUND` (404) si el equipo no existe o el tipo de componente es inválido.
     *      - `HTTP_INTERNAL_SERVER_ERROR` (500) si ocurre algún error inesperado.
     */
    public function addComponenteEquipo($id, array $componenteEquipoDTOs);

    public function getRepairsTableEquipo($id);

}
