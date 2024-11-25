<?php

namespace App\Http\Controllers\Terceros;

use App\DTOs\Terceros\Tercero\PersonaNatural\PersonaNaturalCreateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Terceros\PersonaNaturalCreateRequest;
use App\Services\Interfaces\Terceros\PersonaNatural\IPersonaNaturalServices;
use Illuminate\Http\Request;

class TercerosController extends Controller
{
    protected IPersonaNaturalServices $personaNaturalServices;

    public function __construct(IPersonaNaturalServices $iPersonaNaturalServices)
    {
        $this->personaNaturalServices = $iPersonaNaturalServices;
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
     * Display the specified resource.
     */
    public function createTerceroJuridico(string $id)
    {
        //
    }

}
