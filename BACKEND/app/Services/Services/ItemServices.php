<?php

namespace App\Services\Services;

use App\Config\Global\env;
use App\Config\Global\EnvConfig;
use App\Config\Items\Equipo\EquipoConfig;
use App\Config\Items\Oficina\OficinaConfig;
use App\DTOs\Datatable\DatatableDTO;
use App\DTOs\ItemDTOs\Basico\ItemBasicoDTO;
use App\DTOs\ItemDTOs\EquiposDTOs\EquipoDTO;
use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateDTO;
use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemCreateDTO;
use App\DTOs\ItemDTOs\ItemViewPaginationDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ComponenteEquipoDTO;
use App\DTOs\ResourceDTOs\ResourceDTO;
use App\DTOs\ResponsesDTO\ResponseDTO;
use App\Models\Inventory\EquipoComponentes;
use App\Repositories\Interfaces\InterfaceEquipoRespository;
use App\Repositories\Interfaces\InterfaceItemBasicoRepository;
use App\Repositories\Interfaces\InterfaceItemRepository;
use App\Repositories\Interfaces\InterfaceResourceRepository;
use App\Repositories\Interfaces\InterfacesSerialCodesRepository;
use App\Services\Interfaces\InterfaceItemServices;
use App\Utils\ResponseHandler;
use App\Utils\Utilidades;
use Exception;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class ItemServices implements InterfaceItemServices
{

    protected InterfaceItemRepository $itemRepository;
    protected InterfaceResourceRepository $resourceRepository;
    protected InterfaceEquipoRespository $equipoRespository;
    protected InterfaceItemBasicoRepository $itemBasicoRepository;
    protected InterfacesSerialCodesRepository $serialCodesRepository;
    public function __construct(
        InterfaceItemRepository $interfaceItemRepository,
        InterfaceResourceRepository $interfaceResourceRepository,
        InterfaceEquipoRespository $interfaceEquiposRespository,
        InterfaceItemBasicoRepository $interfaceItemBasicoRepository,
        InterfacesSerialCodesRepository $interfacesSerialCodesRepository,
    ) {
        $this->resourceRepository = $interfaceResourceRepository;
        $this->itemRepository = $interfaceItemRepository;
        $this->equipoRespository = $interfaceEquiposRespository;
        $this->itemBasicoRepository = $interfaceItemBasicoRepository;
        $this->serialCodesRepository = $interfacesSerialCodesRepository;
    }
    /**
     * Crea un item.
     *@param ItemBasicoCreateRequestDTO $itemBasicoCreateDTO   
     *Datos del item para crear
     *@param mixed $resource 
     *Imagen capturada con la función file de la request
     * @return JsonResponse
     */
    public function create(ItemBasicoCreateRequestDTO $itemBasicoCreateRequestDTO): JsonResponse
    {
        $responseHandler = new ResponseHandler();

        try {

            $itemCreateDTO = ItemCreateDTO::fromArray($itemBasicoCreateRequestDTO->toArray());

            $itemBasicoCreateDTO = new ItemBasicoCreateDTO($itemBasicoCreateRequestDTO->toArray());
            $itemBasicoCreateDTO->item_id = $itemCreateDTO->item_id;


            if (!$this->serialCodesRepository->codeExistByCode($itemBasicoCreateDTO->serie_lote)) {
                return $responseHandler->setMessages("El tipo de codigo a registar no existe: {$itemBasicoCreateDTO->serie_lote} ")
                    ->setStatus(Response::HTTP_NOT_FOUND)->responses();
            }

            $pathResource = [];
            $nombre = Utilidades::sanitizeString($itemBasicoCreateDTO->name);
            $uuid = uniqid($nombre);
            $pathImage = OficinaConfig::getPathFile();
            foreach ($itemBasicoCreateRequestDTO->resource ?? [] as $resource) {
                $ruta = $resource->store("$pathImage$uuid", 'public');
                $resourcesDTO = new ResourceDTO(asset(EnvConfig::getDefaulSaveFiles() . "/$ruta"), $itemCreateDTO->item_id, null);
                $pathResource[] = $resourcesDTO->toArray();
            }


            $prefixSerielote = $itemBasicoCreateDTO->serie_lote;
            // $itemBasicoCreateDTO->serie_lote = null;

            $this->itemRepository->create($itemCreateDTO->toArray());
            $this->resourceRepository->createRecords($pathResource);

            $itemBasico = $this->itemBasicoRepository->create($itemBasicoCreateDTO->toArray(), $prefixSerielote);

            return $responseHandler->setData(new ItemBasicoDTO($itemBasico ?? null))
                ->setMessages("Item Basico Creado Exitosamente")
                ->setStatus(200)
                ->responses();

        } catch (\Throwable $th) {
            return $responseHandler->handleException($th);
        } catch (Exception $e) {
            return $responseHandler->handleException($e);
        }
    }


    /**
     * Lista los items por paginación
     * @return ResponseDTO
     */
    public function listItemPagination($perPage, $page, $search, $category = null): ResponseDTO
    {
        try {

            $items = $this->itemRepository->paginationItems(
                $perPage,
                $page,
                $search,
                $category
            );

            $items->getCollection()->transform(function ($item) {
                return ItemViewPaginationDTO::fromModel($item);
            });

            return new ResponseDTO('Datos Traidos Exitosamente', $items, Response::HTTP_OK);

        } catch (\Throwable $th) {
            return new ResponseDTO("Error al listar los items : {$th->getMessage()}", $th, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * @inheritDoc
     */
    public function createEquipo(EquiposCreateRequestDTO $equiposCreateRequestDTO, array|UploadedFile|null $resource)
    {
        $responseHandler = new ResponseHandler();
        try {

            $url = '';
            $itemCreateDTO = ItemCreateDTO::fromArray($equiposCreateRequestDTO->toArray());
            $nombreEquipo = Utilidades::sanitizeString($equiposCreateRequestDTO->name);

            $equipoCreateDTO = EquiposCreateDTO::fromArray($equiposCreateRequestDTO->toArray());
            $equipoCreateDTO->item_id = $itemCreateDTO->item_id;

            if (
                $this->equipoRespository->equipoExistBySerialLote($equipoCreateDTO->serie_lote) ||
                $this->itemBasicoRepository->itemBasicoExistBySerialLote($equipoCreateDTO->serie_lote)
            ) {
                return $responseHandler->setMessages("El serial que intenta registrar ya fue registrado")
                    ->setStatus(Response::HTTP_CONFLICT)->responses();
            }

            $pathImage = EquipoConfig::getPathFile() . '/' . uniqid($nombreEquipo);

            if ($resource) {
                $ruta = $resource->store($pathImage, 'public');
                $url = EnvConfig::getDefaulSaveFiles() . '/' . asset($ruta);
            }

            if ($resource) {
                $resourceDTO = new ResourceDTO($url, $itemCreateDTO->item_id, null);
            }

            $componentesEquipoDTO = array_map(function (ComponenteEquipoDTO $componenteEquipoDTO) use ($itemCreateDTO) {
                $componenteEquipoDTO->itemId = $itemCreateDTO->item_id;
                return $componenteEquipoDTO->toArray();
            }, $equiposCreateRequestDTO->componentes);


            $this->itemRepository->create($itemCreateDTO->toArray());
            $this->resourceRepository->create($resourceDTO);
            $this->equipoRespository->create($equipoCreateDTO->toArray());
            $this->equipoRespository->createComponentesEquipo($componentesEquipoDTO);

            return $responseHandler->setData($equipoCreateDTO->toArray())
                ->setMessages("Equipo Creado Exitosamente")
                ->setStatus(200)
                ->responses();

        } catch (Exception $e) {
            return $responseHandler->handleException($e, 500);
        } catch (QueryException $qe) {
            return $responseHandler->handleException($qe);
        }
    }

    public function addComponenteEquipo($id, array $componenteEquipoDTOs)
    {
        try {
            // Verifica que el equipo exista en el repositorio
            if (!$this->equipoRespository->equipoExistByItemID($id)) {
                return new ResponseDTO("El equipo no existe", Response::HTTP_NOT_FOUND);
            }

            $validTypes = EquipoConfig::getValidTypes();
            $componentes = [];

            // Itera sobre cada componente y verifica su validez
            foreach ($componenteEquipoDTOs ?? [] as $componenteEquipoDTO) {
                $componenteEquipoDTO->itemId = $id;

                // Valida el tipo del componente
                if (!in_array($componenteEquipoDTO->type, $validTypes, true)) {
                    return new ResponseDTO("Tipo inválido para el componente de equipo.", Response::HTTP_NOT_FOUND);
                }

                // Convierte el componente a un array y lo almacena
                $componentes[] = $componenteEquipoDTO->toArray();
            }

            // Registra los componentes en el repositorio
            $this->equipoRespository->createComponentesEquipo($componentes);

            // Retorna una respuesta de éxito
            return new ResponseDTO("Refacción Registrada Correctamente", $componentes, Response::HTTP_CREATED);
        } catch (Exception $e) {
            // Captura errores y retorna un mensaje con código de error 500
            return new ResponseDTO($e->getMessage(), null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
    public function getRepairsTableEquipo($id)
    {
        try {
            $equipoComponente = new EquipoComponentes();
            $equipoComponenteQuery = EquipoComponentes::on();
            $datatableDTO = new DatatableDTO();

            $request = Request::capture();

            // $query = $this->_equipoRepository->getQueryBuild();
            $columns = $equipoComponenteQuery->getConnection()->getSchemaBuilder()
                ->getColumnListing($equipoComponente->getTable());

            $datatableDTO->recordsTotal = $equipoComponenteQuery->count();
            $datatableDTO->draw = intval($request->input('draw', 1));

            $length = $request->input('length', 10);
            $start = $request->input('start', 0);
            $search = $request->input('search.value', null);
            $orders = $request->input('order', null);

            if ($search) {
                $equipoComponenteQuery->where(function (Builder $q) use ($search, $columns) {
                    foreach ($columns ?? [] as $column) {
                        $q->orWhere($column, 'like', "%$search%");
                    }
                });
            }

            $columnFilters = $request->input('columnFilters', []);
            $columnsFilters = $request->input('columns', []);

            foreach ($columnFilters as $index => $filter) {
                if (!empty($filter) && isset($columns[$index])) {
                    $equipoComponenteQuery->where($columnsFilters[$index]["data"], 'like', "%$filter%");
                }
            }

            $datatableDTO->recordsFiltered = $equipoComponenteQuery->count();

            if ($orders) {
                foreach ($orders as $order) {
                    $columnIndex = $order['column'];
                    $columnName = $columns[$columnIndex] ?? null;
                    $direction = $order['dir'];
                    if ($columnName) {
                        $equipoComponenteQuery->orderBy($columnName, $direction);
                    }
                }
            }
            // $equipoComponenteQuery->where('usuario_id', '=', $idUsuario);

            if ($length != -1) {
                $equipoComponenteQuery->offset($start)->limit($length);
            }

            $datatableDTO->data = $equipoComponenteQuery->get();
            return $datatableDTO;
            // return response()->json($datatableDTO);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function detailEquipo($itemId)
    {
        try {
            // Obtener el equipo utilizando el repositorio
            $equipo = $this->equipoRespository->getEquipoByItemID($itemId);
            // Transformar el equipo en un DTO
            $equipoDTO = new EquipoDTO($equipo);
            // Devolver una respuesta exitosa
            return new ResponseDTO('Item econtrado exitosamente', $equipoDTO);
        } catch (\Throwable $th) {
            // Manejo de errores y devolución de respuesta con mensaje detallado
            return new ResponseDTO(
                "Error al crear detalle del equipo {$th->getMessage()}",
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function detailOficina($itemId)
    {
        try {
            // Obtener el item básico utilizando el repositorio
            $itemBasico = $this->itemBasicoRepository->getItemBasicoByItemId($itemId);

            // Transformar el item básico en un DTO
            $itemOficinaDTO = new ItemBasicoDTO($itemBasico);

            // Devolver una respuesta exitosa
            return new ResponseDTO(
                'Item Encontrado Exitosamente',
                $itemOficinaDTO
            );

        } catch (\Throwable $th) {
            // Manejo de errores y devolución de respuesta con mensaje detallado
            return new ResponseDTO(
                'Error en el servicio de detalle de item oficina: ' . $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

    }
}