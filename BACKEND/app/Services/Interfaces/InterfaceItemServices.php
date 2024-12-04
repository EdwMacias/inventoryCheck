<?php

namespace App\Services\Interfaces;

use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateDTO;
use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemCreateDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ComponenteEquipoDTO;
use App\DTOs\ResponsesDTO\ResponseDTO;
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
    public function listItemPagination($perPage, $page, $search, $category = null): ResponseDTO;

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

    /**
     * Proporciona los detalles de un equipo
     *
     * Este método obtiene la información detallada de un equipo utilizando su `itemId`.
     * Convierte la información en un DTO (`EquipoDTO`) para una representación estructurada
     * y devuelve un `ResponseDTO` con el resultado.
     *
     * @param string $itemId
     *      El identificador único del equipo a consultar.
     *
     * @return ResponseDTO
     *      - Si el equipo se encuentra correctamente:
     *          - `message`: "Item encontrado exitosamente".
     *          - `data`: Instancia de `EquipoDTO` con la información del equipo.
     *      - En caso de error:
     *          - `message`: Mensaje de error detallado.
     *          - `status`: Código de estado HTTP 500 (Error Interno del Servidor).
     *
     * @throws \Exception
     *      Este método captura cualquier error interno y lo maneja devolviendo un mensaje
     *      detallado en la respuesta.
     */
    public function detailEquipo($itemId);
    /**
     * Obtiene el detalle de un Item de Oficina
     *
     * Este método proporciona el detalle de un item de oficina, transformándolo en un DTO para su
     * representación estandarizada. Si ocurre un error, devuelve una respuesta con un mensaje y código
     * de estado HTTP 500.
     *
     * @param string $itemId
     *      El identificador único del item a consultar.
     *
     * @return ResponseDTO
     *      - Si el item se encuentra correctamente, devuelve un objeto `ResponseDTO` con:
     *          - Mensaje de éxito.
     *          - Instancia de `ItemBasicoDTO` representando el item.
     *      - En caso de error, devuelve un objeto `ResponseDTO` con:
     *          - Mensaje de error detallado.
     *          - Código de estado HTTP 500.
     */
    public function detailOficina($itemId);
}
