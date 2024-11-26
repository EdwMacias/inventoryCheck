<?php

namespace App\Services\Services\Terceros\PersonaJuridica;

use App\DTOs\ResponsesDTO\ResponseDTO;
use App\DTOs\Terceros\Tercero\PersonaJuridica\PersonaJuridicaCreateDTO;
use App\DTOs\Terceros\Tercero\PersonaJuridica\PersonaJuridicaDTO;
use App\Repositories\Interfaces\Terceros\PersonaJuridica\IPersonaJuridicaRepository;
use App\Services\Interfaces\Terceros\PersonaJuridica\IPersonaJuridicaService;
use Symfony\Component\HttpFoundation\Response;

class PersonaJuridicaService implements IPersonaJuridicaService
{

    protected IPersonaJuridicaRepository $personaJuridicaRepository;

    public function __construct(IPersonaJuridicaRepository $iPersonaJuridicaRepository)
    {
        $this->personaJuridicaRepository = $iPersonaJuridicaRepository;
    }

    /**
     * @inheritDoc
     */
    public function create(PersonaJuridicaCreateDTO $personaJuridicaCreateDTO)
    {
        // Verifica si ya existe una Persona Jurídica con el email dado
        if ($this->personaJuridicaRepository->existByEmail($personaJuridicaCreateDTO->email)) {
            return new ResponseDTO(
                'Email ya se encuentra registrado',
                $personaJuridicaCreateDTO,
                Response::HTTP_CONFLICT
            );
        }

        // Verifica si ya existe una Persona Jurídica con el NIT dado
        if ($this->personaJuridicaRepository->existByNit($personaJuridicaCreateDTO->nit)) {
            return new ResponseDTO(
                'NIT ya se encuentra registrado',
                $personaJuridicaCreateDTO,
                Response::HTTP_CONFLICT
            );
        }

        // Crea la Persona Jurídica
        $personaJuridica = $this->personaJuridicaRepository->create($personaJuridicaCreateDTO->toArray());

        // Convierte el registro creado en un DTO
        $personaJuridicaDTO = new PersonaJuridicaDTO($personaJuridica);

        // Devuelve una respuesta indicando que la creación fue exitosa
        return new ResponseDTO(
            'Persona Juridica Creada Satisfactoriamente',
            $personaJuridicaDTO,
            Response::HTTP_CREATED
        );
    }
}
