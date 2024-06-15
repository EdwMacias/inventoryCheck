<?php

namespace App\Services\Services;

use App\DTOs\ItemDTOs\ItemCreateDTO;
use App\DTOs\ItemDTOs\ItemViewPaginationDTO;
use App\DTOs\ResourceDTOs\ResourceDTO;
use App\Repositories\Interfaces\InterfaceItemRepository;
use App\Repositories\Interfaces\InterfaceResourceRepository;
use App\Services\Interfaces\InterfaceItemServices;
use App\Utils\ResponseHandler;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class ItemServices implements InterfaceItemServices
{

    protected InterfaceItemRepository $itemRepository;
    protected InterfaceResourceRepository $resourceRepository;

    public function __construct(InterfaceItemRepository $interfaceItemRepository, InterfaceResourceRepository $interfaceResourceRepository)
    {
        $this->resourceRepository = $interfaceResourceRepository;
        $this->itemRepository = $interfaceItemRepository;
    }
    /**
     * Crea un item.
     *@param ItemCreateDTO $item   
     *Datos del item para crear
     *@param mixed $resource 
     *Imagen capturada con la función file de la request
     * @return JsonResponse
     */
    public function create(ItemCreateDTO $itemCreateDTO, $resource): JsonResponse
    {
        $responseHandle = new ResponseHandler();

        try {

            $ruta = $resource->store('imagenes', 'public');
            $url = asset($ruta);
            $resourceDTO = new ResourceDTO($url, $itemCreateDTO->item_id, null);

            $result = $this->itemRepository->getItemByName($itemCreateDTO->name);

            if ($result) {
                throw new Exception("Ya existe este nombre", Response::HTTP_CONFLICT);
            }

            $result = $this->itemRepository->getItemBySerialNumber($itemCreateDTO->serial_number);

            if ($result) {
                throw new Exception("Este serial ya fue agregado", Response::HTTP_CONFLICT);
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

}