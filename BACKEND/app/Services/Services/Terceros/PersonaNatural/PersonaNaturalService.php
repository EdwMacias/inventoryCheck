<?php

namespace App\Services\Services\Terceros\PersonaNatural;

use App\DTOs\ResponsesDTO\ResponseDTO;
use App\DTOs\Terceros\Tercero\PersonaNatural\PersonaNaturalCreateDTO;
use App\DTOs\Terceros\Tercero\PersonaNatural\PersonaNaturalDTO;
use App\Repositories\Interfaces\Terceros\PersonaNatural\IPersonaNaturalRepository;
use App\Services\Interfaces\Terceros\PersonaNatural\IPersonaNaturalServices;
use Symfony\Component\HttpFoundation\Response;

/**
 * Clase PersonaNaturalService
 * Maneja las operaciones relacionadas con el registro y consulta de personas naturales.
 */
class PersonaNaturalService implements IPersonaNaturalServices
{
    /**
     * Repositorio de Persona Natural
     *
     * @var IPersonaNaturalRepository
     */
    protected IPersonaNaturalRepository $personaNaturalRepository;
    /**
     * Constructor de la clase
     *
     * @param IPersonaNaturalRepository $iPersonaNaturalRepository
     */
    public function __construct(IPersonaNaturalRepository $iPersonaNaturalRepository)
    {
        $this->personaNaturalRepository = $iPersonaNaturalRepository;
    }

    public function create(PersonaNaturalCreateDTO $personaNaturalCreateDTO)
    {
        if ($this->personaNaturalRepository->existByNumberIdentification($personaNaturalCreateDTO->numeroIdentificacion)) {
            return new ResponseDTO('El número de identificacion ya fue registrado', $personaNaturalCreateDTO, Response::HTTP_CONFLICT);
        }

        if ($personaNaturalCreateDTO->correo && $this->personaNaturalRepository->existByEmail($personaNaturalCreateDTO->correo)) {
            return new ResponseDTO('El correo ya fue registrado', $personaNaturalCreateDTO, Response::HTTP_CONFLICT);
        }

        $personaNatural = $this->personaNaturalRepository->create($personaNaturalCreateDTO->toArray());
        $personaNaturalDTO = new PersonaNaturalDTO($personaNatural);

        return new ResponseDTO('Persona Natural Registrada Con Satisfactoriamente', $personaNaturalDTO, Response::HTTP_CREATED);
    }

    public function showById(string $personaNaturalId)
    {
        $personaNatural = $this->personaNaturalRepository->getById($personaNaturalId);
        $personaNaturalDTO = new PersonaNaturalDTO($personaNatural);
        return new ResponseDTO('Datos Obtenidos Exitosamente', $personaNaturalDTO, Response::HTTP_OK);
    }

}
