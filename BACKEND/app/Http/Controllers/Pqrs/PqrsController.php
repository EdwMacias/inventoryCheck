<?php

namespace App\Http\Controllers\Pqrs;

use App\DTOs\PqrsDTOs\Request\PqrsRequestCreateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pqrs\PqrsRequestCreate;
use App\Services\Interfaces\InterfacePqrsServices;

class PqrsController extends Controller
{
    protected InterfacePqrsServices $_pqrsServices;

    
    public function __construct(InterfacePqrsServices $interfacePqrsServices)
    {
        $this->middleware('auth:api', ['except' => ['store']]);
        $this->_pqrsServices = $interfacePqrsServices;
    }

    /**
     * Almacena un nuevo recurso de PQRS en el almacenamiento.
     *
     * @param PqrsRequestCreate $pqrsRequestCreate La solicitud que contiene los datos para crear un nuevo PQRS.
     * @return \Illuminate\Http\JsonResponse La respuesta JSON con el resultado de la operación.
     */
    public function store(PqrsRequestCreate $pqrsRequestCreate)
    {
        //
        $pqrsRequestCreateDTO = new PqrsRequestCreateDTO($pqrsRequestCreate->toArray());
        $responseDTO = $this->_pqrsServices->create($pqrsRequestCreateDTO);

        return response()->json($responseDTO, $responseDTO->status);
    }

    /**
     * Muestra los registros de PQRS.
     *
     * @return \Illuminate\Http\JsonResponse La respuesta JSON con los registros de PQRS y el código de estado HTTP.
     */
    public function show()
    {
        $responseDTO = $this->_pqrsServices->getPqrs();
        return response()->json($responseDTO, $responseDTO->status);
    }
}
