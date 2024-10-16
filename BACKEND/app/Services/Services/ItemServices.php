<?php

namespace App\Services\Services;

use App\DTOs\ItemDTOs\Basico\ItemBasicoDTO;
use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateDTO;
use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemCreateDTO;
use App\DTOs\ItemDTOs\ItemViewPaginationDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ComponenteEquipoDTO;
use App\DTOs\ResourceDTOs\ResourceDTO;
use App\Repositories\Interfaces\InterfaceEquipoRespository;
use App\Repositories\Interfaces\InterfaceItemBasicoRepository;
use App\Repositories\Interfaces\InterfaceItemRepository;
use App\Repositories\Interfaces\InterfaceResourceRepository;
use App\Repositories\Interfaces\InterfacesSerialCodesRepository;
use App\Services\Interfaces\InterfaceItemServices;
use App\Utils\ResponseHandler;
use App\Utils\Utilidades;
use Exception;
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
            foreach ($itemBasicoCreateRequestDTO->resource ?? [] as $resource) {
                $ruta = $resource->store("imagenes/item/basico/$nombre", 'public');
                $resourcesDTO = new ResourceDTO(asset("storage/$ruta"), $itemCreateDTO->item_id, null);
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
     * @return JsonResponse
     */
    public function listItemPagination(): JsonResponse
    {
        $responseHandler = new ResponseHandler();

        try {
            $request = Request::capture();

            $perPage = $request->input('perPage', 10);
            $page = $request->input('page', 1);
            $search = $request->input('search', '');

            $items = $this->itemRepository->paginationItems($perPage, $page, $search);

            $items->getCollection()->transform(function ($item) {
                return ItemViewPaginationDTO::fromModel($item);
            });

            return $responseHandler->setData($items)
                ->setMessages("Datos Traídos Correctamente")
                ->responses();

        } catch (\Throwable $th) {
            return $responseHandler->handleException($th);
        } catch (QueryException $qe) {
            return $responseHandler->handleException($qe);
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

            if ($resource) {
                $ruta = $resource->store('imagenes', 'public');
                $url = 'storage/' . asset($ruta);
            }


            $equipoCreateDTO = EquiposCreateDTO::fromArray($equiposCreateRequestDTO->toArray());
            $equipoCreateDTO->item_id = $itemCreateDTO->item_id;

            if (
                $this->equipoRespository->equipoExistBySerialLote($equipoCreateDTO->serie_lote) ||
                $this->itemBasicoRepository->itemBasicoExistBySerialLote($equipoCreateDTO->serie_lote)
            ) {
                return $responseHandler->setMessages("El serial que intenta registrar ya fue registrado")
                    ->setStatus(Response::HTTP_CONFLICT)->responses();
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
}