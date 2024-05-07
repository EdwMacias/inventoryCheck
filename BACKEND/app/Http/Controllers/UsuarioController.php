<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth:api', ['except' => ['updatePassword', 'getCodeTemporal','authenticacionCode']]);
        $this->_usuarioService = $_interfaceUsuarioServices;
        $this->_temporaryServices = $interfaceTemporaryCodeServices;
    }


    public function store(UsuarioRequest $request)
    {
        $usuario = $request->all();
        $mensaje = $this->_usuarioService->crearUsuario($usuario);
        return $mensaje->responses();
    }

    public function show()
    {
        return $this->_usuarioService->obtenerUsuarios();
    }

    public function update($id, UsuarioRequest $request)
    {
        $usuario = $request->all();
        $mensaje = $this->_usuarioService->actualizarUsuario($id, $usuario);
        return $mensaje->responses();

    }

    public function destroy(int $id)
    {
        $mensaje = $this->_usuarioService->eliminarUsuario($id);
        return $mensaje->responses();
    }

    public function updatePassword($code, UpdatePasswordRequest $request)
    {
        $password = $request->all();
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

    public function getUsuarioId($id)
    {
        $response = $this->_usuarioService->obtenerUsuarioId($id);
        return $response->responses();
    }
}
