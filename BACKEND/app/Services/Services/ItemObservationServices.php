<?php

namespace App\Services\Services;

use App\Custom\Http\Request;
use App\DTOs\Datatable\DatatableDTO;
use App\DTOs\ItemDTOs\EquiposDTOs\EquipoDTO;
use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionCreateDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionEquipoCreateRequestDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionEquipoDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionEquipoTableDTO;
use App\DTOs\ResourceDTOs\ResourceDTO;
use App\Models\Inventory\Observaciones\EquipoObservacion;
use App\Repositories\Interfaces\InterfaceEquipoRespository;
use App\Repositories\Interfaces\InterfaceItemObservationRepository;
use App\Repositories\Interfaces\InterfaceResourceRepository;
use App\Repositories\Interfaces\InterfaceTypesObservationRepository;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;
use App\Services\Interfaces\InterfaceItemObservationServices;
use App\Utils\ResponseHandler;
use App\Utils\Utilidades;
use Exception;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ItemObservationServices implements InterfaceItemObservationServices
{

    protected InterfaceUsuarioRepository $usuarioRepository;
    protected InterfaceEquipoRespository $_equipoRepository;
    protected InterfaceItemObservationRepository $itemObservationRepository;
    protected InterfaceTypesObservationRepository $typeObservationRepository;
    protected InterfaceResourceRepository $resourceRepository;

    public function __construct(
        InterfaceItemObservationRepository $interfaceItemObservationRepository,
        InterfaceEquipoRespository $interfaceEquipoRespository,
        InterfaceUsuarioRepository $interfaceUsuarioRepository,
        InterfaceTypesObservationRepository $interfaceTypesObservationRepository,
        InterfaceResourceRepository $interfaceResourceRepository
    ) {
        $this->usuarioRepository = $interfaceUsuarioRepository;
        $this->_equipoRepository = $interfaceEquipoRespository;
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
            // if (!$this->itemRepository->existItemByItemId($itemObservationDTO->item_id)) {
            //     return throw new Exception("El item enviado no existe", Response::HTTP_NOT_FOUND);
            // }

            // if (!$this->typeObservationRepository->existTypeObservationByTypeObservatioId($itemObservationDTO->types_observation_id)) {
            //     return throw new Exception("La observación seleccionada no fue encontrada", Response::HTTP_NOT_FOUND);
            // }

            // if (!$this->usuarioRepository->userExist($itemObservationDTO->user_id)) {
            //     return throw new Exception("El usuario no existe", Response::HTTP_NOT_FOUND);
            // }

            // $response = $this->itemObservationRepository->create($itemObservationDTO);

            // if ($response) {
            //     foreach ($resources as $resource) {
            //         $ruta = $resource->store('imagenes', 'public');
            //         $url = asset('storage/' . $ruta);
            //         $resourceDTO = new ResourceDTO($url, null, $itemObservationDTO->item_observation_id);
            //         $this->resourceRepository->create($resourceDTO);
            //     }
            // }

            return $responseHandler->setData(null)->setMessages("Observación Creada")->responses();

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

            // if (!$this->itemRepository->existItemByItemId($itemId)) {
            //     return throw new Exception("El item buscado no existe", Response::HTTP_NOT_FOUND);
            // }

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
    /**
     * Summary of createObservacionEquipo
     * @param \App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionEquipoCreateRequestDTO $equiposCreateRequestDTO
     * @return \Illuminate\Http\JsonResponse
     */
    public function createObservacionEquipo(ObservacionEquipoCreateRequestDTO $observacionEquipoCreateRequestDTO): JsonResponse
    {
        // return true;
        $responseHandler = new ResponseHandler();
        try {
            $observacionCreateDTO = new ObservacionCreateDTO();
            $observacionCreateDTO->user_id = auth()->user()->getAuthIdentifier();

            $equipo = $this->_equipoRepository->getEquipoByEquipoID($observacionEquipoCreateRequestDTO->equipo_id);

            if (!$equipo) {
                throw new Exception("Equipo no encontrado", Response::HTTP_NOT_FOUND);
            }

            $equipoDTO = new EquipoDTO($equipo);
            $observacionCreateDTO->item_id = $equipoDTO->item_id;

            $date = Utilidades::sanitizeString(date("Y-m-d H:i:s"));
            $nombreEquipo = Utilidades::sanitizeString($equipoDTO->name);

            $ruta = $observacionEquipoCreateRequestDTO->firma_responsable->store("imagenes/firmas/observacion/equipo/$nombreEquipo/$date", 'public');
            $observacionEquipoCreateRequestDTO->firma_responsable = asset("storage/$ruta");
            $itemObservacion = $this->itemObservationRepository->createObservacionEquipo($observacionEquipoCreateRequestDTO->toArray());
            $itemObservacionDTO = new ObservacionEquipoDTO($itemObservacion);

            $pathResource = [];

            $observacionCreateDTO->types_observation_id = 4;

            $observacionDTO = new ObservacionDTO($this->itemObservationRepository->create($observacionCreateDTO->toArray()));

            foreach ($observacionEquipoCreateRequestDTO->resource as $resource) {
                $ruta = $resource->store('imagenes/observacion/equipos', 'public');
                $url = asset("storage/$ruta");
                $resourcesDTO = new ResourceDTO($url, null, $observacionDTO->item_observation_id);
                $pathResource[] = $resourcesDTO->toArray();
            }

            $observacionEquipoCreateRequestDTO->resource = $pathResource;

            // $itemObservacionDTO
            $this->resourceRepository->createRecords($pathResource);

            $responseHandler->setData($itemObservacionDTO)->setMessages('Observacion Creada Correctamente');
            return $responseHandler->responses();
        } catch (Exception $e) {
            return $responseHandler->handleException($e);
        }
    }
    public function getEquipoObservaciones($itemID)
    {
        $responseHandler = new ResponseHandler();
        $datatableDTO = new DatatableDTO();
        $request = Request::capture();
        $observaciones = new EquipoObservacion();

        // return response()->json($this->_equipoRepository->equipoExistByItemID($itemID));
        if (!$this->_equipoRepository->equipoExistByItemID($itemID)) {
            return $responseHandler->setMessages("Equipo no encontrado")->setData($datatableDTO)->setStatus(Response::HTTP_NOT_FOUND)->responses();
        }

        $equipo = $this->_equipoRepository->getEquipoByItemID($itemID);

        $equipoDTO = new EquipoDTO($equipo);

        $query = $this->itemObservationRepository->getTableEquipoObservacionByEquipoId($equipoDTO->equipo_id);

        $draw = intval($request->input('draw', 1));
        $searchValue = $request->input('search.value', null);

        $datatableDTO->recordsTotal = $query->count();
        $datatableDTO->draw = $draw;
        $columns = $query->getConnection()->getSchemaBuilder()->getColumnListing($observaciones->getTable());

        if ($searchValue) {
            $query->where(function (Builder $q) use ($searchValue, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', "%$searchValue%");
                }
            });
        }

        $datatableDTO->recordsFiltered = $query->count();

        if ($request->input('order')) {
            # code...
            foreach ($request->input('order') as $order) {
                $columnIndex = $order['column'];
                $columnName = $columns[$columnIndex] ?? null;
                $direction = $order['dir'];

                if ($columnName) {
                    $query->orderBy($columnName, $direction);
                }
            }
        }

        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        if ($length != -1) {
            $query->offset($start)->limit($length);
        }

        $datatableDTO->data = $query->get()->transform(function ($observaciones) {
            return new ObservacionEquipoTableDTO($observaciones);
        });

        return Response()->json($datatableDTO);
    }
}
