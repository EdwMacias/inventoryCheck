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
    /**
     * @inheritDoc
     */
    public function existByNumberIdentification(string $numberIdentification)
    {
        try {
            // Consulta la existencia del número de identificación en la tabla `PersonaNatural`.
            return PersonaNatural::where('numero_identificacion', $numberIdentification)->exists();
        } catch (\Throwable $th) {
            // Lanza una excepción con un mensaje descriptivo en caso de error.
            throw new Exception(
                'Error al buscar la persona natural por número de identificación: ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    /**
     * @inheritDoc
     */
    public function existByEmail(string $email)
    {
        try {
            // Consulta la existencia del correo en la tabla `PersonaNatural`.
            return PersonaNatural::where('correo', $email)->exists();
        } catch (\Throwable $th) {
            // Lanza una excepción con un mensaje descriptivo en caso de error.
            throw new Exception(
                'Error al buscar la persona natural por el email: ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
  
    public function getTerceroByEmail($email)
    {
        try {
            $personaNatural = PersonaNatural::where('correo', $email)->first();

            if (!$personaNatural) {
                throw new Exception("Persona Natural no encontrada", 404);
            }

            return $personaNatural;

        } catch (\Throwable $th) {
            throw new Exception("Error al traer datos por email del tercero natural : {$th->getMessage()}", 500);
            ;
        }
    }
    public function getTerceroById($id)
    {
        try {
            $personaNatural = PersonaNatural::where('id', $id)->first();

            if (!$personaNatural) {
                throw new Exception("Persona Natural no encontrada", 404);
            }

            return $personaNatural;

        } catch (\Throwable $th) {
            throw new Exception("Error al traer datos por id del tercero natural : {$th->getMessage()}", 500);
            ;
        }
    }
}
