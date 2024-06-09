<?php

namespace App\Http\Controllers\Usuario;

use App\DTOs\Usuario\UsuarioCreateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UsuarioRequest;
use App\Services\Interfaces\InterfaceTemporaryCodeServices;
use App\Services\Interfaces\InterfaceUsuarioServices;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{

    protected InterfaceUsuarioServices $_usuarioService;
    protected InterfaceTemporaryCodeServices $_temporaryServices;

    public function __construct(InterfaceUsuarioServices $_interfaceUsuarioServices, InterfaceTemporaryCodeServices $interfaceTemporaryCodeServices)
    {
        $this->middleware('auth:api', ['except' => ['updatePassword', 'getCodeTemporal', 'authenticacionCode']]);
        $this->_usuarioService = $_interfaceUsuarioServices;
        $this->_temporaryServices = $interfaceTemporaryCodeServices;
    }

    /**
     * recupera todos los usuarios por filtraciones ssr
     */
    public function show()
    {
        return $this->_usuarioService->obtenerUsuarios();
    }
    
    /**
     * Crea un usuario
     * @param UsuarioRequest $usuarioRequest
     */
    public function store(UsuarioRequest $usuarioRequest)
    {
        $usuarioCreateDTO = UsuarioCreateDTO::fromArray($usuarioRequest->all());
        return $this->_usuarioService->crearUsuario($usuarioCreateDTO);
    }

    /**
     * Actualiza un usuario
     * @param $id
     * id del usuario
     * @param UsuarioRequest $usuarioRequest
     */
    public function update($id, UsuarioRequest $usuarioRequest)
    {
        $usuarioCreateDTO = UsuarioCreateDTO::fromArray($usuarioRequest->all());
        return $this->_usuarioService->actualizarUsuario($id, $usuarioCreateDTO);
    }
    /**
     * Inactiva un usuario
     * @param $id
     * id del usuario
     */
    public function inactivar($id)
    {
        return $this->_usuarioService->inactivar($id);
    }
    /**
     * Activa un usuario
     * @param $id
     * id del usuario
     */
    public function activar($id)
    {
        return $this->_usuarioService->activar($id);
    }

    public function updatePassword($code, UpdatePasswordRequest $updatePasswordRequest)
    {
        $password = $updatePasswordRequest->all();
        $response = $this->_usuarioService->updatePassword($code, $password);
        return $response->responses();
    }

    public function getCodeTemporal($email)
    {
        $response = $this->_temporaryServices->createCodeTemporary($email);
        return $response->responses();
    }

    public function authenticacionCode(Request $request)
    {
        $email = htmlspecialchars($request->input('email'), ENT_QUOTES);
        $codigo = htmlspecialchars($request->input('codigo'), ENT_QUOTES);
        $response = $this->_temporaryServices->validateCodeTemporary($codigo, $email);
        return $response->responses();
    }

    /**
     * obtiene el usuario por el id
     */
    public function getUsuarioId($id)
    {
        return $this->_usuarioService->obtenerUsuarioId($id);
    }
}
