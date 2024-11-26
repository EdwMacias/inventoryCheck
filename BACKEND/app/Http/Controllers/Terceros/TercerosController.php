<?php

namespace App\Http\Controllers\Terceros;

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

}