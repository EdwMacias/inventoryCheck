<?php

namespace App\Services\Services;

use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateDTO;
use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemCreateDTO;
use App\DTOs\ItemDTOs\ItemViewPaginationDTO;
use App\DTOs\ResourceDTOs\ResourceDTO;
use App\Repositories\Interfaces\InterfaceEquipoRespository;
use App\Repositories\Interfaces\InterfaceItemRepository;
use App\Repositories\Interfaces\InterfaceResourceRepository;
use App\Services\Interfaces\InterfaceItemServices;
use App\Utils\ResponseHandler;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ItemServices implements InterfaceItemServices
{

    protected InterfaceItemRepository $itemRepository;
    protected InterfaceResourceRepository $resourceRepository;
    protected InterfaceEquipoRespository $equipoRespository;

    public function __construct(
        InterfaceItemRepository $interfaceItemRepository,
        InterfaceResourceRepository $interfaceResourceRepository,
        InterfaceEquipoRespository $interfaceEquiposRespository
    ) {
        $this->resourceRepository = $interfaceResourceRepository;
        $this->itemRepository = $interfaceItemRepository;
        $this->equipoRespository = $interfaceEquiposRespository;
    }
    /**
     * Crea un item.
     *@param ItemCreateDTO $item   
     *Datos del item para crear
     *@param mixed $resource 
     *Imagen capturada con la función file de la request
     * @return JsonResponse
     */
    public function create(ItemCreateDTO $itemCreateDTO, array|UploadedFile|null $resource): JsonResponse
    {
        $responseHandle = new ResponseHandler();

        try {
            if ($resource) {
                $ruta = $resource->store('imagenes', 'public');
                $url = 'storage/' . asset($ruta);
                $resourceDTO = new ResourceDTO($url, $itemCreateDTO->item_id, null);
            }

            $this->itemRepository->create($itemCreateDTO);
            $this->resourceRepository->create($resourceDTO);

            return $responseHandle->setData(true)->setMessages("Creado")->setStatus(200)->responses();
        } catch (\Throwable $th) {
            return $responseHandle->handleException($th);
        } catch (Exception $e) {
            return $responseHandle->handleException($e);
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

            $items = $this->itemRepository->paginationItems($perPage, $page);

            $items->getCollection()->transform(function ($item) {
                return ItemViewPaginationDTO::fromModel($item);
            });

            return $responseHandler->setData($items)->setMessages("Datos Traídos Correctamente")->responses();

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
            //code...
            $itemCreateDTO = ItemCreateDTO::fromArray($equiposCreateRequestDTO->toArray());
            $url = '';
            // return $responseHandler->setData($itemCreateDTO->toArray())
            //     ->setMessages("Equipo Creado Exitosamente")
            //     ->setStatus(200)
            //     ->responses();

            if ($resource) {
                $ruta = $resource->store('imagenes', 'public');
                $url = 'storage/' . asset($ruta);
            }

            $resourceDTO = new ResourceDTO($url, $itemCreateDTO->item_id, null);
            // $equipoCreateDTO = EquiposCreateDTO::fromArray($equiposCreateRequestDTO->toArray());
            // $equipoCreateDTO->item_id = $itemCreateDTO->item_id;
            $equipoCreateDTO = EquiposCreateDTO::fromArray($equiposCreateRequestDTO->toArray());
            $equipoCreateDTO->item_id = $itemCreateDTO->item_id;
            // return $responseHandler->setData($equipoCreateDTO->toArray())
            //     ->setMessages("Equipo Creado Exitosamente")
            //     ->setStatus(200)
            //     ->responses();
            $this->itemRepository->create($itemCreateDTO);
            $this->resourceRepository->create($resourceDTO);
            $this->equipoRespository->create($equipoCreateDTO->toArray());

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