<?php

namespace App\Http\Controllers\Item;

use App\DTOs\ItemDTOs\EquiposDTOs\EquiposCreateRequestDTO;
use App\DTOs\ItemDTOs\ItemBasicoCreateRequestDTO;
use App\DTOs\ItemDTOs\ObservacionesDTOs\ComponenteEquipoDTO;
use App\DTOs\ResponsesDTO\ResponseDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\Items\Equipo\EquipoRequest;
use App\Http\Requests\Items\Equipo\RepuestosEquipoRequest;
use App\Repositories\Interfaces\InterfaceItemRepository;
use App\Repositories\Interfaces\InterfaceRolesUserRepository;
use App\Services\Interfaces\InterfaceItemServices;
use Illuminate\Http\Request;
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
     *
     * Este método permite paginar los elementos de una lista. Los parámetros de entrada determinan la página
     * que se renderizará, el criterio de búsqueda y la categoría por la que se filtra.
     *
     * @param Request $request
     *      - `page` (int): Número de página a renderizar (opcional, predeterminado: 1).
     *      - `search` (string): Término de búsqueda para filtrar elementos (opcional, predeterminado: '').
     *      - `categoria` (int|null): ID de la categoría para filtrar elementos (opcional, predeterminado: null).
     *
     * @return \Illuminate\Http\JsonResponse
     *      Una respuesta JSON con la lista paginada de elementos.
     *      - Contiene los datos de los elementos paginados y un estado HTTP.
     *      - La estructura de `responseDTO` depende de la implementación del servicio `itemService`.
     */
    public function pagination(Request $request)
    {
        $page = $request->input('page', 1); // Página solicitada, por defecto la primera
        $search = $request->input('search', ''); // Criterio de búsqueda, por defecto vacío
        $category = $request->input('categoria', null); // Categoría, por defecto null
        $perPage = $request->input('size', 10); // Limite de datos a mostrar, por defecto 10

        $perPage = is_numeric($perPage) ? intval($perPage) : 10;
        $perPage = ($perPage > 50) ? 50 : $perPage;

        // Llama al servicio para obtener los elementos paginados
        $responseDTO = $this->itemService->listItemPagination(
            $perPage,
            $page,
            $search,
            $category
        );

        // Devuelve la respuesta en formato JSON con el estado HTTP correspondiente
        return response()->json($responseDTO, $responseDTO->status);
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
    /**
     * Agrega ítems de reparación a un equipo específico.
     * 
     * @param mixed $id - ID del equipo al que se agregarán los componentes de reparación.
     * @param \App\Http\Requests\Items\Equipo\RepuestosEquipoRequest $repuestosEquipoRequest - Solicitud que contiene los datos de los componentes.
     * @return mixed|\Illuminate\Http\JsonResponse - Respuesta JSON con el resultado de la operación.
     */
    public function addRepairItemEquipo($id, RepuestosEquipoRequest $repuestosEquipoRequest)
    {
        // Inicializa un array vacío para almacenar los datos de los componentes.
        $componenteEquipoDTOs = [];

        // Itera sobre cada componente proporcionado en la solicitud, si existen componentes.
        foreach ($repuestosEquipoRequest->componentes ?? [] as $componente) {
            // Crea una nueva instancia de ComponenteEquipoDTO con los datos del componente.
            $componenteEquipoDTO = new ComponenteEquipoDTO($componente);

            // Establece el tipo de componente como "repuesto" usando la configuración de tipo.
            $componenteEquipoDTO->type = \App\Config\Items\Equipo\EquipoConfig::getTypeRepuesto();

            // Agrega el DTO del componente al array de componentes.
            $componenteEquipoDTOs[] = $componenteEquipoDTO;
        }

        // Llama al servicio para agregar los componentes al equipo con el ID especificado.
        $responseDTO = $this->itemService->addComponenteEquipo($id, $componenteEquipoDTOs);

        // Devuelve una respuesta en formato JSON, utilizando el estado de la respuesta como código de estado HTTP.
        return response()->json($responseDTO, $responseDTO->status);

    }
    /**
     * Proporciona los detalles de un item de oficina
     *
     * Este método actúa como un punto de entrada para obtener los detalles de un item de oficina.
     * Llama al servicio correspondiente para recuperar la información y devuelve una respuesta JSON
     * estructurada en un objeto `ResponseDTO`.
     *
     * @param string $id
     *      El identificador único del item de oficina.
     *
     * @return \Illuminate\Http\JsonResponse
     *      Una respuesta JSON que incluye:
     *          - `data`: Detalles del item en formato estructurado.
     *          - `message`: Mensaje que indica el estado de la operación.
     *          - `status`: Código de estado HTTP asociado.
     */
    public function detailOficina($id)
    {
        // Llamar al servicio para obtener los detalles del item
        $responseDTO = $this->itemService->detailOficina($id);

        // Devolver la respuesta en formato JSON con el estado HTTP correspondiente
        return response()->json($responseDTO, $responseDTO->status);
    }
    /**
     * Obtiene los detalles de un equipo
     *
     * Este método sirve como un punto de entrada para obtener los detalles de un equipo asociado a un ID específico.
     * Llama al servicio correspondiente para procesar la lógica de negocio y devuelve una respuesta JSON estructurada.
     *
     * @param int|string $id
     *      El identificador único del equipo a consultar.
     *
     * @return \Illuminate\Http\JsonResponse
     *      Una respuesta JSON con:
     *          - `data`: Detalles del equipo en un formato estructurado.
     *          - `message`: Mensaje que indica el estado de la operación.
     *          - `status`: Código de estado HTTP asociado.
     */
    public function detailEquipo($id)
    {
        // Llamar al servicio para obtener los detalles del equipo
        $responseDTO = $this->itemService->detailEquipo($id);

        // Devolver la respuesta en formato JSON con el estado HTTP correspondiente
        return response()->json($responseDTO, $responseDTO->status);

    }

}
