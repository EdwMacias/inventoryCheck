<?php

namespace App\Services\Services;

use App\Custom\Http\Request;
use App\DTOs\Datatable\DatatableDTO;
use App\DTOs\ItemDTOs\Basico\ItemBasicoDTO;
use App\DTOs\ItemDTOs\EquiposDTOs\EquipoDTO;
use App\DTOs\ItemDTOs\ItemObservationDTO;
use App\DTOs\ItemDTOs\ItemObservationUpdateDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ItemBasico\Request\ItemBasicoObservacionCreateDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ItemBasico\Request\ItemBasicoObservacionRequestDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ItemBasico\Request\ItemBasicoRequestDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ItemBasico\Response\ItemBasicoObservacionResponseDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionCreateDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionEquipoCreateRequestDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionEquipoDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ObservacionEquipoTableDTO;
use App\DTOs\ResourceDTOs\ResourceDTO;
use App\DTOs\ResourceDTOs\ResourcesResponseDTO;
use App\DTOs\ResponsesDTO\ResponseDTO;
use App\Models\Inventory\Observaciones\EquipoObservacion;
use App\Repositories\Interfaces\InterfaceEquipoRespository;
use App\Repositories\Interfaces\InterfaceItemBasicoRepository;
use App\Repositories\Interfaces\InterfaceItemObservationRepository;
use App\Repositories\Interfaces\InterfaceResourceRepository;
use App\Repositories\Interfaces\InterfaceTypesObservationRepository;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;
use App\Repositories\Repositories\ItemBasicoRepository;
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
    protected InterfaceItemBasicoRepository $itemBasicoRepository;
    protected InterfaceResourceRepository $resourceRepository;

    public function __construct(
        InterfaceItemObservationRepository $interfaceItemObservationRepository,
        InterfaceEquipoRespository $interfaceEquipoRespository,
        InterfaceUsuarioRepository $interfaceUsuarioRepository,
        InterfaceTypesObservationRepository $interfaceTypesObservationRepository,
        InterfaceResourceRepository $interfaceResourceRepository,
        InterfaceItemBasicoRepository $interfaceItemBasicoRepository,
    ) {
        $this->usuarioRepository = $interfaceUsuarioRepository;
        $this->_equipoRepository = $interfaceEquipoRespository;
        $this->itemObservationRepository = $interfaceItemObservationRepository;
        $this->typeObservationRepository = $interfaceTypesObservationRepository;
        $this->resourceRepository = $interfaceResourceRepository;
        $this->itemBasicoRepository = $interfaceItemBasicoRepository;
    }

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

    public function createObservacionItemBasico(ItemBasicoObservacionRequestDTO $itemBasicoRequestDTO): ResponseDTO
    {
        $pathsResources = [];

        $observacionCreateDTO = new ObservacionCreateDTO();
        $itemBasicoObservacionCreateDTO = new ItemBasicoObservacionCreateDTO($itemBasicoRequestDTO);

        $itemBasico = $this->itemBasicoRepository->getItemBasicoByItemId($itemBasicoRequestDTO->itemId);

        if (!$itemBasico) {
            return new ResponseDTO("No se encontro el item basico", $itemBasico, Response::HTTP_NOT_FOUND);
        }

        $itemBasicoDTO = new ItemBasicoDTO($itemBasico);
        $itemBasicoObservacionCreateDTO->itemBasicoId = $itemBasicoDTO->itemBasicoId;

        $observacionCreateDTO->user_id = $itemBasicoRequestDTO->userId ?? auth()->user()->getAuthIdentifier();
        $observacionCreateDTO->types_observation_id = $itemBasicoRequestDTO->tipoObservacionId;
        $observacionCreateDTO->item_id = $itemBasicoDTO->itemId;

        if (!$this->typeObservationRepository->existTypeObservationByTypeObservatioId($itemBasicoRequestDTO->tipoObservacionId)) {
            return new ResponseDTO("El tipo de observación no existe", $itemBasicoRequestDTO, Response::HTTP_NOT_FOUND);
        }


        $date = Utilidades::sanitizeString(date("Y-m-d H:i:s"));
        $nombreEquipo = Utilidades::sanitizeString($itemBasicoDTO->nombre);

        foreach ($itemBasicoRequestDTO->imagenes as $resource) {
            $ruta = $resource->store("imagenes/observacion/item/basico/$nombreEquipo/$date", 'public');
            $url = asset("storage/$ruta");
            $resourcesDTO = new ResourceDTO($url, null, $observacionCreateDTO->item_observation_id);
            $pathsResources[] = $resourcesDTO->toArray();
        }

        $itemBasicoObservacion = $this->itemBasicoRepository->createObservacion($itemBasicoObservacionCreateDTO->toArray());
        $this->itemObservationRepository->create($observacionCreateDTO->toArray());
        $this->resourceRepository->createRecords($pathsResources);

        $itemBasicoObservacionResponseDTO = new ItemBasicoObservacionResponseDTO($itemBasicoObservacion);

        $pathsResources = array_map(function ($resource) {
            $resource['resource'] = url($resource['resource']);
            return $resource;
        }, $pathsResources);

        $itemBasicoObservacionResponseDTO->imagenes = $pathsResources;

        return new ResponseDTO("Se creo exitosamente la observacion", $itemBasicoObservacionResponseDTO);
    }

    public function getObservacionItemOficinaByItemId($itemID)
    {
        $responseHandler = new ResponseHandler();
        $datatableDTO = new DatatableDTO();
        $request = Request::capture();
        $observaciones = new EquipoObservacion();

        // return response()->json($this->_equipoRepository->equipoExistByItemID($itemID));
        if (!$this->itemBasicoRepository->getItemBasicoByItemId($itemID)) {
            return $responseHandler->setMessages("Equipo no encontrado")->setData($datatableDTO)->setStatus(Response::HTTP_NOT_FOUND)->responses();
        }

        $equipo = $this->itemBasicoRepository->getItemBasicoByItemId($itemID);

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
