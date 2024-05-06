<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePasswordRequest;
use App\Http\Requests\UsuarioRequest;
use App\Services\Interfaces\InterfaceUsuarioServices;

class UsuarioController extends Controller
{
    protected InterfaceUsuarioServices $_usuarioService;

    public function __construct(InterfaceUsuarioServices $_interfaceUsuarioServices)
    {
        $this->middleware('auth:api', ['except' => ['updatePassword']]);
        $this->_usuarioService = $_interfaceUsuarioServices;
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

    public function updatePassword($id, UpdatePasswordRequest $request)
    {
        $password = $request->all();
        $response = $this->_usuarioService->updatePassword($id, $password);
        return $response->responses();
    }

    public function getUsuarioId($id)
    {
        $response = $this->_usuarioService->obtenerUsuarioId($id);
        return $response->responses();
    }
}
