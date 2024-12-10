<?php

namespace App\DTOs\Datatable;

use Illuminate\Http\Request;

/**
 * Clase DTO (Data Transfer Object) para manejar los datos de la solicitud de datatables.
 * 
 * Esta clase encapsula los parámetros enviados por la solicitud para facilitar su 
 * uso en la lógica de negocio relacionada con datatables.
 */
class RequestDatatableDTO
{
    /**
     * @var int $draw
     * Número de solicitud de la tabla, utilizado para identificar las respuestas en datatables.
     */
    public $draw;

    /**
     * @var string|null $searchValue
     * Valor de búsqueda enviado por el cliente para filtrar datos.
     */
    public $searchValue;

    /**
     * @var array|null $order
     * Información de ordenación, incluyendo las columnas y las direcciones (ascendente o descendente).
     */
    public $order;

    /**
     * @var int $start
     * Índice de inicio de los registros para paginación.
     */
    public $start;

    /**
     * @var int $length
     * Número de registros por página (longitud de los datos paginados).
     */
    public $length;

    /**
     * Constructor de la clase.
     *
     * @param \Illuminate\Http\Request $request
     *     La solicitud HTTP que contiene los datos necesarios para construir el DTO.
     *
     * ### Ejemplo de Datos de Solicitud:
     * ```json
     * {
     *     "draw": 1,
     *     "start": 0,
     *     "length": 10,
     *     "search": { "value": "texto de búsqueda" },
     *     "order": [{ "column": 0, "dir": "asc" }]
     * }
     * ```
     */
    public function __construct(Request $request)
    {
        $this->draw = intval($request->input('draw', 1));
        $this->searchValue = $request->input('search.value', null);
        $this->order = $request->input('order', null);
        $this->start = $request->input('start', 0);
        $this->length = $request->input('length', 10);
    }
}
