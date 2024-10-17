<?php

namespace App\Http\Controllers\Item;

use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateRequestDTO;
use App\DTOs\ResponsesDTO\ResponseDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\Items\Equipo\EquipoRequest;
use App\Repositories\Interfaces\InterfaceItemRepository;
use App\Repositories\Interfaces\InterfaceRolesUserRepository;
use App\Repositories\Interfaces\InterfaceUsuarioRepository;
use App\Services\Interfaces\InterfaceItemServices;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    protected InterfaceItemServices $itemService;
    protected InterfaceItemRepository $itemRepository;
    protected InterfaceRolesUserRepository $usuarioRoleRepository;

    public function __construct(
        InterfaceItemServices $interfaceItemServices,
        InterfaceRolesUserRepository $interfaceRolesUserRepository,
        InterfaceItemRepository $interfaceItemRepository
    ) {
        $this->itemService = $interfaceItemServices;
        $this->usuarioRoleRepository = $interfaceRolesUserRepository;
        $this->itemRepository = $interfaceItemRepository;
        $this->middleware('auth:api');
    }

    /**
     * Crea un item
     * @param ItemRequest $itemCreacionRequest
     * request de creacion
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ItemRequest $itemCreacionRequest)
    {
        $itemCreateDto = new ItemBasicoCreateRequestDTO($itemCreacionRequest->all());
        // return $itemCreacionRequest->all();
        // return response()->json( $itemCreateDto);

        return $this->itemService->create($itemCreateDto);
    }

    /**
     * Pagina los items
     * perpage determina los items a mostrar
     * page la pagina que va a renderizar
     */
    public function pagination()
    {
        // return []
        return $this->itemService->listItemPagination();
    }

    public function createEquipo(EquipoRequest $equipoRequest)
    {
        $equipoRequest->merge([
            'cond_electrica' => filter_var($equipoRequest->input('cond_electrica'), FILTER_VALIDATE_BOOLEAN),
            'cond_mecanica' => filter_var($equipoRequest->input('cond_mecanica'), FILTER_VALIDATE_BOOLEAN),
            'cond_ambientales' => filter_var($equipoRequest->input('cond_ambientales'), FILTER_VALIDATE_BOOLEAN),
            'cond_seguridad' => filter_var($equipoRequest->input('cond_seguridad'), FILTER_VALIDATE_BOOLEAN),
            'cond_transporte' => filter_var($equipoRequest->input('cond_transporte'), FILTER_VALIDATE_BOOLEAN),
            'cond_otras' => filter_var($equipoRequest->input('cond_otras'), FILTER_VALIDATE_BOOLEAN),
        ]);

        $equipoRequest->validate([
            'cond_electrica' => 'required|bool',
            'cond_mecanica' => 'required|bool',
            'cond_ambientales' => 'required|bool',
            'cond_seguridad' => 'required|bool',
            'cond_transporte' => 'required|bool',
            'cond_otras' => 'required|bool',
        ]);

        $equipoCreateRequestDTO = EquiposCreateRequestDTO::fromArray($equipoRequest->all());
        // return response()->json($equipoCreateRequestDTO);
        return $this->itemService->createEquipo($equipoCreateRequestDTO, $equipoRequest->file("resource"));
    }
    /**
     * Elimina un item dado su ID, después de verificar que el usuario autenticado 
     * tiene los permisos necesarios.
     *
     * @param mixed $id El identificador del item a eliminar.
     * 
     * @return \Illuminate\Http\JsonResponse Retorna una respuesta JSON indicando 
     * el resultado de la operación:
     * - Si el usuario no tiene permisos, retorna un error con código 401.
     * - Si el item se elimina correctamente, retorna un mensaje de éxito con código 200.
     * 
     * @throws \Exception Si ocurre un error en la eliminación del item.
     */
    public function destroy($id)
    {
        // Obtener el ID del usuario autenticado
        $userId = auth()->user()->getAuthIdentifier();

        // Verificar si el usuario tiene el rol necesario 
        if (!$this->usuarioRoleRepository->roleInUser("1", $userId)) {

            // Retornar error si el usuario no tiene los permisos requeridos
            return response()->json(
                new ResponseDTO("El usuario no cuenta con los permisos requeridos", [], Response::HTTP_UNAUTHORIZED),
                Response::HTTP_UNAUTHORIZED
            );
        }

        // Eliminar el item con el repositorio correspondiente
        $this->itemRepository->delete($id);

        // Retornar respuesta de éxito
        return response()->json(
            new ResponseDTO("Item Eliminado", true, Response::HTTP_OK),
            Response::HTTP_OK
        )->withHeaders([
                    'Content-Type' => 'application/json',
                    'Cache-Control' => 'no-store, no-cache, must-revalidate',
                    'X-Content-Type-Options' => 'nosniff',
                    'X-Frame-Options' => 'DENY',
                    'X-XSS-Protection' => '1; mode=block',
                    'Access-Control-Allow-Origin' => '*',
                ]);

    }

}
