<?php

namespace App\Services\Interfaces\Terceros\PersonaJuridica;

use App\DTOs\Datatable\DatatableDTO;
use App\DTOs\Datatable\RequestDatatableDTO;
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
    /**
     * Recupera una tabla de datos ("datatable") de terceros (entidades jurídicas)
     * basada en los criterios de búsqueda, filtrado y ordenación proporcionados.
     *
     * @param RequestDatatableDTO $requestDatatableDTO
     *     Objeto de transferencia de datos que contiene los parámetros de la solicitud
     *     para la tabla, incluyendo opciones de paginación, búsqueda y ordenación.
     *
     * @return DatatableDTO
     *     Objeto de transferencia de datos que contiene los resultados procesados de la tabla,
     *     incluyendo el total de registros, registros filtrados y las filas de datos.
     *
     * @throws \Exception
     *     Si ocurre un error durante el procesamiento de la tabla, se lanza una excepción
     *     con un mensaje detallado y un código de estado HTTP 500.
     *
     * ### Detalles:
     * - **Columnas soportadas para búsqueda y ordenación:**
     *   - id
     *   - razon_social (razón social)
     *   - nit (número de identificación tributaria)
     *   - telefono (teléfono)
     *   - email
     *   - created_at (fecha de creación)
     *   - updated_at (fecha de actualización)
     *
     * ### Ejemplo de Uso:
     * ```php
     * $datatableDTO = $this->getTercerosTable($requestDatatableDTO);
     * ```
     *
     * ### Flujo de Trabajo:
     * 1. Inicializa una instancia de `DatatableDTO` para almacenar los resultados.
     * 2. Consulta el modelo `PersonaJuridica` para obtener los datos.
     * 3. Aplica los filtros de búsqueda si se proporciona un término de búsqueda.
     * 4. Actualiza `recordsFiltered` con el número de registros después del filtrado.
     * 5. Aplica la ordenación y paginación si se especifican en la solicitud.
     * 6. Transforma los datos recuperados en objetos `PersonaJuridicaTableDTO`.
     * 7. Devuelve el `DatatableDTO` completo.
     */
    public function getTercerosTable(RequestDatatableDTO $requestDatatableDTO): DatatableDTO;
        /**
     * Obtiene los detalles de un tercero juridico a partir de su correo electrónico.
     *
     * @param string $email
     *     El correo electrónico del tercero juridico cuyos detalles se desean obtener.
     *
     * @return \App\DTOs\ResponsesDTO\ResponseDTO
     *     Un objeto de transferencia de datos (`ResponseDTO`) que contiene el mensaje y
     *     los detalles del tercero juridico encapsulados en un `PersonaJuridicaDTO`.
     */
    public function getDetailsTercero($email);

}
