<?php

namespace App\Services\Services;

use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDTO;
use App\DTOs\ResourceDTOs\ResourceDTO;
use App\Repositories\Interfaces\InterfaceItemObservationRepository;
use App\Repositories\Interfaces\InterfaceItemRepository;
use App\Repositories\Interfaces\InterfaceResourceRepository;
use App\Repositories\Interfaces\InterfaceTypesObservationRepository;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;
use App\Services\Interfaces\InterfaceItemObservationServices;
use App\Utils\ResponseHandler;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ItemObservationServices implements InterfaceItemObservationServices
{

    protected InterfaceUsuarioRepository $usuarioRepository;
    protected InterfaceItemRepository $itemRepository;
    protected InterfaceItemObservationRepository $itemObservationRepository;
    protected InterfaceTypesObservationRepository $typeObservationRepository;
    protected InterfaceResourceRepository $resourceRepository;


    public function __construct(
        InterfaceItemObservationRepository $interfaceItemObservationRepository,
        InterfaceItemRepository $interfaceItemRepository,
        InterfaceUsuarioRepository $interfaceUsuarioRepository,
        InterfaceTypesObservationRepository $interfaceTypesObservationRepository,
        InterfaceResourceRepository $interfaceResourceRepository
    ) {
        $this->usuarioRepository = $interfaceUsuarioRepository;
        $this->itemRepository = $interfaceItemRepository;
        $this->itemObservationRepository = $interfaceItemObservationRepository;
        $this->typeObservationRepository = $interfaceTypesObservationRepository;
        $this->resourceRepository = $interfaceResourceRepository;
    }

    /**
     *
     * @param ItemObservationDTO $itemObservationDTO
     * dto con los datos a crear de la observacion del item
     * @param UploadedFile $resource
     * recursos a cargar de la observacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(ItemObservationDTO $itemObservationDTO, array $resources)
    {
        $responseHandler = new ResponseHandler();
        try {
            //code...
            if (!$this->itemRepository->existItemByItemId($itemObservationDTO->item_id)) {
                return throw new Exception("El item enviado no existe", Response::HTTP_NOT_FOUND);
            }

            if (!$this->typeObservationRepository->existTypeObservationByTypeObservatioId($itemObservationDTO->types_observation_id)) {
                return throw new Exception("La observación seleccionada no fue encontrada", Response::HTTP_NOT_FOUND);
            }

            if (!$this->usuarioRepository->userExist($itemObservationDTO->user_id)) {
                return throw new Exception("El usuario no existe", Response::HTTP_NOT_FOUND);
            }

            $response = $this->itemObservationRepository->create($itemObservationDTO);

            if ($response) {
                foreach ($resources as $resource) {
                    $ruta = $resource->store('imagenes', 'public');
                    $url = asset('storage/' . $ruta);
                    $resourceDTO = new ResourceDTO($url, null, $itemObservationDTO->item_observation_id);
                    $this->resourceRepository->create($resourceDTO);
                }
            }

            return $responseHandler->setData($response)->setMessages("Observación Creada")->responses();

        } catch (Throwable $th) {
            return $responseHandler->handleException($th);
        } catch (QueryException $qe) {
            return $responseHandler->handleException($qe);
        }

    }

    /**
     *
     * @param string $observationId
     * id de la observacion a buscar
     */
    public function getObservationByObservationId(string $observationId)
    {
        $responseHandler = new ResponseHandler();
        try {

            if (!$this->itemObservationRepository->exitsObservationByObservationId($observationId)) {
                return throw new Exception("El item buscado no existe", Response::HTTP_NOT_FOUND);
            }

            $response = $this->itemObservationRepository->getObservationByObservationId($observationId);

            return $responseHandler->setData($response)->setMessages("Datos Traidos Exitosamente")->responses();

        } catch (Throwable $th) {
            return $responseHandler->handleException($th);
        } catch (QueryException $qe) {
            return $responseHandler->handleException($qe);
        }
    }

    /**
     *
     * @param string $itemId
     * id del item a buscar por observaciones
     */
    public function getObservationsByItemId(string $itemId)
    {
        $responseHandler = new ResponseHandler();
        try {

            if (!$this->itemRepository->existItemByItemId($itemId)) {
                return throw new Exception("El item buscado no existe", Response::HTTP_NOT_FOUND);
            }

            $response = $this->itemObservationRepository->getAllObservationByItemId($itemId);

            return $responseHandler->setData($response)->setMessages("Datos Traidos Exitosamente")->responses();

        } catch (Throwable $th) {
            return $responseHandler->handleException($th);
        } catch (QueryException $qe) {
            return $responseHandler->handleException($qe);
        }

    }

    /**
     *
     * @param string $observationId
     * id de la observacion a actualizar
     * @param ItemObservationDTO $itemObservationDTO
     * dto con los parametros a actualizar
     */
    public function update(string $observationId, ItemObservationUpdateDTO $itemObservationUpdateDto)
    {
        $responseHandler = new ResponseHandler();
        try {
            $itemObservation = $this->itemObservationRepository->getObservationByObservationId($observationId);

            if (!$itemObservation) {
                return throw new Exception("Observación no encontrada", Response::HTTP_NOT_FOUND);
            }

            if (!$this->typeObservationRepository->existTypeObservationByTypeObservatioId($itemObservationUpdateDto->types_observation_id)) {
                return throw new Exception("La observación seleccionada no fue encontrada", Response::HTTP_NOT_FOUND);
            }

            $userAuth = auth()->user();

            if ($userAuth->user_id != $itemObservation->user_id) {
                return throw new Exception("Esta observación no puede ser alterada por este usuario", Response::HTTP_NOT_FOUND);
            }

            if ($itemObservation->hasBeenFiveMinutesSinceCreation()) {
                return throw new Exception("Tiempo limite de actualización expirado", Response::HTTP_NOT_FOUND);
            }

            $response = $this->itemObservationRepository->update($observationId, $itemObservationUpdateDto);

            return $responseHandler->setData($response)->setMessages("Observación Actualizada")->responses();

        } catch (Throwable $th) {
            return $responseHandler->handleException($th);
        } catch (QueryException $qe) {
            return $responseHandler->handleException($qe);
        }
    }
}
