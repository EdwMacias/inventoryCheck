<?php

namespace App\Repositories\Repositories\Terceros\PersonaNatural;

use App\Models\Terceros\PersonaNatural\PersonaNatural;
use App\Repositories\Interfaces\Terceros\PersonaNatural\IPersonaNaturalRepository;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class PersonaNaturalRespository implements IPersonaNaturalRepository
{

    /**
     * @inheritDoc
     */
    public function create(array $datos)
    {
        try {
            return PersonaNatural::create($datos);
        } catch (\Throwable $th) {
            throw new Exception('Error al crear un registro en la tabla persona natural: ' . $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @inheritDoc
     */
    public function getAll()
    {
        try {
            return PersonaNatural::all() ?? null;
        } catch (\Throwable $th) {
            throw new Exception('Error al traer los datos de la tabla persona natural: ' . $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        try {
            return PersonaNatural::find($id)->first();
        } catch (\Throwable $th) {
            throw new Exception('Error al traer la persona natural por id: ' . $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}