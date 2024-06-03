<?php

namespace App\Services\Services;

use App\Models\Inventory\Item;
use App\Models\Views\ItemView;
use App\Respositories\Interfaces\InterfaceItemRepository;
use App\Respositories\Interfaces\InterfaceResourceRepository;
use App\Services\Interfaces\InterfaceItemServices;
use App\Utils\ResponseHandler;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
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
     *
     *@param array $item   
     *Datos del item para crear
     *@param mixed $resource 
     *Imagen capturada con la función file de la request
     * @return JsonResponse
     */

    public function create(array $item, $resource): JsonResponse
    {
        $responseHandle = new ResponseHandler();

        try {
            //code...
            $primaryKey = uuid_create();

            $item = [
                "item_id" => $primaryKey,
                "name" => $item["name"],
                "serial_number" => $item["serial_number"],
                "description" => $item["description"],
            ];

            $ruta = $resource->store('imagenes', 'public');
            $url = asset('storage/' . $ruta);

            $resource = [
                "item_id" => $primaryKey,
                "resource" => $url
            ];

            $result = $this->itemRepository->getItemByName($item["name"]);

            if ($result) {
                throw new Exception("Ya existe este nombre", Response::HTTP_CONFLICT);
            }

            $result = $this->itemRepository->getItemBySerialNumber($item["serial_number"]);

            if ($result) {
                throw new Exception("Este serial ya fue agregado", Response::HTTP_CONFLICT);
            }


            $this->itemRepository->create($item);
            $this->resourceRepository->create($resource);

            return $responseHandle->setData(true)->setMessages("Creado")->setStatus(200)->responses();
        } catch (\Throwable $th) {
            return $responseHandle->handleException($th);
        } catch (Exception $e) {
            return $responseHandle->handleException($e);
        }
    }


    /**
     * Devuelve una lista de los items.
     *
     *
     * @return JsonResponse
     */
    public function listItemPagination(): JsonResponse
    {
        $responseHandler = new ResponseHandler();
        try {
            $items = ItemView::paginate(10);

            $items->getCollection()->transform(function ($item) {
                $item->resource = url($item->resource);
                return $item;
            });

            return $responseHandler->setData($items)->setMessages("Datos Traidos Correctamente")->responses();

        } catch (\Throwable $th) {
            return $responseHandler->handleException($th);
        } catch (QueryException $qe) {
            return $responseHandler->handleException($qe);
        }

    }


    // public function update($id, array $item): JsonResponse
    // {
    //     throw new Exception("Error Processing Request", 1);
    // }
}
