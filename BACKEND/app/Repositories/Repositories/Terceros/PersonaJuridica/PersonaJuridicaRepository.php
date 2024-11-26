<?php

namespace App\Repositories\Repositories\Terceros\PersonaJuridica;

use App\Models\Terceros\PersonaJuridica\PersonaJuridica;
use App\Repositories\Interfaces\Terceros\PersonaJuridica\IPersonaJuridicaRepository;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class PersonaJuridicaRepository implements IPersonaJuridicaRepository
{
    /**
     * @inheritDoc
     */
    public function create(array $datos)
    {
        try {
            return PersonaJuridica::create($datos);
        } catch (\Throwable $th) {
            throw new Exception("Error al crear la persona juridica: " . $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @inheritDoc
     */
    public function existByEmail(string $email)
    {
        try {
            return PersonaJuridica::where('email', $email)->exists();
        } catch (\Throwable $th) {
            throw new Exception("Error al buscar por email a la persona juridica: " . $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @inheritDoc
     */
    public function existByNit(string $nit)
    {
        try {
            return PersonaJuridica::where('nit', $nit)->exists();
        } catch (\Throwable $th) {
            throw new Exception("Error al buscar por nit a la persona juridica: " . $th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
