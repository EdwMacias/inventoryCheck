<?php

namespace App\Http\Controllers\Terceros;

use App\DTOs\Datatable\RequestDatatableDTO;
use App\DTOs\Terceros\Tercero\PersonaJuridica\PersonaJuridicaCreateDTO;
use App\DTOs\Terceros\Tercero\PersonaNatural\PersonaNaturalCreateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Terceros\PersonaJuridicaCreateRequest;
use App\Http\Requests\Terceros\PersonaNaturalCreateRequest;
use App\Services\Interfaces\Terceros\PersonaJuridica\IPersonaJuridicaService;
use App\Services\Interfaces\Terceros\PersonaNatural\IPersonaNaturalServices;
use Illuminate\Http\Request;

class TercerosController extends Controller
{
    protected IPersonaNaturalServices $personaNaturalServices;
    protected IPersonaJuridicaService $personaJuridicaService;

    public function __construct(IPersonaNaturalServices $iPersonaNaturalServices, IPersonaJuridicaService $iPersonaJuridicaService)
    {
        $this->personaNaturalServices = $iPersonaNaturalServices;
        $this->personaJuridicaService = $iPersonaJuridicaService;
    }
    /**
     * Crea un nuevo Tercero Persona Natural
     *
     * Este método se encarga de procesar la solicitud para registrar un nuevo tercero de tipo
     * persona natural. Convierte los datos de la solicitud en un DTO de creación, delega la
     * operación de registro al servicio correspondiente y retorna una respuesta JSON con los
     * resultados de la operación.
     *
     * @param PersonaNaturalCreateRequest $personaNaturalCreateRequest
     *     Solicitud que contiene los datos necesarios para registrar la persona natural.
     *
     * @return \Illuminate\Http\JsonResponse
     *     Respuesta JSON que contiene un mensaje, los datos del recurso creado y el código HTTP de estado.
     */
    public function createTerceroNatural(PersonaNaturalCreateRequest $personaNaturalCreateRequest)
    {
        // Convertir la solicitud en un DTO de creación
        $personaNaturalCreateDTO = new PersonaNaturalCreateDTO($personaNaturalCreateRequest);

        // Delegar la creación al servicio y obtener la respuesta
        $responseDTO = $this->personaNaturalServices->create($personaNaturalCreateDTO);

        // Retornar la respuesta en formato JSON con el estado HTTP correspondiente
        return response()->json($responseDTO, $responseDTO->status);
    }

    /**
     * Crea un tercero jurídico basado en la solicitud recibida y devuelve una respuesta JSON.
     *
     * @param mixed $personaJuridicaCreateRequest
     *   La solicitud que contiene los datos necesarios para crear una Persona Jurídica.
     *   Ejemplo:
     *   {
     *       "nombre": "Empresa S.A.S",
     *       "email": "contacto@empresa.com",
     *       "nit": "123456789-0",
     *       "direccion": "Calle 123 #45-67",
     *       ...
     *   }
     *
     * @return \Illuminate\Http\JsonResponse
     *   Una respuesta JSON que contiene:
     *   - `message`: Mensaje de éxito o conflicto.
     *   - `data`: Los datos enviados o el DTO de la Persona Jurídica creada.
     *   - `status`: Código de estado HTTP asociado a la operación.
     *
     * @throws \Exception
     *   Lanza una excepción si ocurre un error durante el proceso de creación.
     */
    public function createTerceroJuridico(PersonaJuridicaCreateRequest $personaJuridicaCreateRequest)
    {
        // Convierte la solicitud en un DTO
        $personaJuridicaCreateDTO = new PersonaJuridicaCreateDTO($personaJuridicaCreateRequest);

        // Llama al servicio para crear la Persona Jurídica
        $responseDTO = $this->personaJuridicaService->create($personaJuridicaCreateDTO);

        // Devuelve la respuesta como JSON
        return response()->json($responseDTO, $responseDTO->status);
    }
    /**
     * Genera la tabla para "Tercero Natural".
     *
     * Este método procesa una solicitud para obtener datos de la tabla relacionada con "Tercero Natural",
     * utiliza los servicios de Persona Natural para recuperar los datos correspondientes
     * y devuelve la información en formato JSON.
     *
     * @param \Illuminate\Http\Request $request Objeto de solicitud HTTP que contiene los parámetros de la tabla.
     * 
     * @return \Illuminate\Http\JsonResponse Respuesta en formato JSON que contiene los datos de la tabla.
     */
    public function tableTerceroNatural(Request $request)
    {

        $requestDatatableDTO = new RequestDatatableDTO($request);

        $datatableDTO = $this->personaNaturalServices->getTercerosTable($requestDatatableDTO);

        return response()->json($datatableDTO);
    }
    /**
     * Maneja la solicitud para obtener la tabla de datos de terceros jurídicos 
     * con paginación, búsqueda y ordenación configuradas.
     *
     * @param \Illuminate\Http\Request $request
     *     La solicitud HTTP que contiene los parámetros necesarios para generar la tabla,
     *     incluyendo paginación, términos de búsqueda y criterios de ordenación.
     *
     * @return \Illuminate\Http\JsonResponse
     *     Respuesta JSON con los datos procesados de la tabla de terceros jurídicos.
     *
     * ### Detalles:
     * - Este método transforma la solicitud en un DTO (`RequestDatatableDTO`) que encapsula
     *   los datos necesarios para la lógica de negocio.
     * - Llama al servicio `PersonaJuridicaService` para obtener los datos de terceros jurídicos
     *   en formato de tabla.
     * - Retorna una respuesta JSON con los datos obtenidos.
     *
     * ### Flujo de Trabajo:
     * 1. Crea una instancia de `RequestDatatableDTO` a partir de los parámetros de la solicitud.
     * 2. Llama al método `getTercerosTable` del servicio `personaJuridicaService` para procesar los datos.
     * 3. Devuelve los resultados como una respuesta JSON.
     *
     * ### Ejemplo de Uso:
     * ```javascript
     * fetch('/api/terceros-juridicos', {
     *     method: 'GET',
     *     headers: {
     *         'Content-Type': 'application/json',
     *     },
     *     body: JSON.stringify({
     *         draw: 1,
     *         start: 0,
     *         length: 10,
     *         search: { value: 'empresa' },
     *         order: [{ column: 1, dir: 'asc' }]
     *     })
     * })
     * .then(response => response.json())
     * .then(data => console.log(data));
     * ```
     */
    public function tableTerceroJuridico(Request $request)
    {

        $requestDatatableDTO = new RequestDatatableDTO($request);

        $datatableDTO = $this->personaJuridicaService->getTercerosTable($requestDatatableDTO);

        return response()->json($datatableDTO);
    }
    /**
     * Obtiene los detalles de un tercero natural a partir de su ID y devuelve una respuesta JSON.
     *
     * @param int $id
     *     El identificador único del tercero natural cuyos detalles se desean obtener.
     *
     * @return \Illuminate\Http\JsonResponse
     *     Respuesta JSON que contiene los detalles del tercero natural encapsulados en un objeto `ResponseDTO`.
     */
    public function getDatallesTerceroNatural($id)
    {

        $responseDTO = $this->personaNaturalServices->getDetailsTercero($id);
        return response()->json($responseDTO, status: $responseDTO->status);

    }
    /**
     * Obtiene los detalles de un tercero jurídico a partir de su ID y devuelve una respuesta JSON.
     *
     * @param int $id
     *     El identificador único del tercero jurídico cuyos detalles se desean obtener.
     *
     * @return \Illuminate\Http\JsonResponse
     *     Respuesta JSON que contiene los detalles del tercero jurídico encapsulados en un objeto `ResponseDTO`.
     */
    public function getDatallesTerceroJuridico($id)
    {
        $responseDTO = $this->personaJuridicaService->getDetailsTercero($id);
        return response()->json($responseDTO, status: $responseDTO->status);
    }
}