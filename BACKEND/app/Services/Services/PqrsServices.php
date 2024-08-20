<?php

namespace App\Services\Services;
use App\DTOs\PqrsDTOs\Request\PqrsRequestCreateDTO;
use App\DTOs\PqrsDTOs\Response\PqrsResponseDTO;
use App\DTOs\ResponsesDTO\ResponseDTO;
use App\Repositories\Interfaces\InterfacePqrsRepository;
use App\Services\Interfaces\InterfacePqrsServices;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class PqrsServices implements InterfacePqrsServices
{

    protected InterfacePqrsRepository $_pqrsRepository;

    public function __construct(InterfacePqrsRepository $interfacePqrsRepository)
    {
        $this->_pqrsRepository = $interfacePqrsRepository;
    }
    public function create(PqrsRequestCreateDTO $pqrsRequestCreateDTO): ResponseDTO
    {
        try {
            $pqrs = $this->_pqrsRepository->create($pqrsRequestCreateDTO->toArray());
            $pqrsResposeDTO = new PqrsResponseDTO($pqrs);
            return new ResponseDTO("PQRS creado exitosamente", $pqrsResposeDTO);
        } catch (Throwable $th) {
            return new ResponseDTO($th->getMessage(), false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
    public function getPqrs(): ResponseDTO
    {
        try {
            $pqrs = $this->_pqrsRepository->get();

            $pqrs = $pqrs->transform(function ($pqrs) {
                return new PqrsResponseDTO($pqrs);
            });

            return new ResponseDTO("Pqrs Obtenidas", $pqrs);
        } catch (Throwable $th) {
            return new ResponseDTO($th->getMessage(), false, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
