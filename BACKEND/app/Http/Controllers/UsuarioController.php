<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Services\Interfaces\InterfaceUsuarioServices;

class UsuarioController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */

    protected InterfaceUsuarioServices $_usuarioService;

    public function __construct(InterfaceUsuarioServices $_interfaceUsuarioServices)
    {
        $this->middleware('auth:api');
        $this->_usuarioService = $_interfaceUsuarioServices;
    }


    public function store(UsuarioRequest $request)
    {
        $usuario = $request->all();
        $mensaje = $this->_usuarioService->crearUsuario($usuario);
        return $mensaje->responses();
    }

    /**
     * Display the specified resource.
     */
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
}
