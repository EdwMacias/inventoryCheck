<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest;
use App\Models\User;
use App\Services\Interfaces\InterfaceUsuarioServices;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */

    protected InterfaceUsuarioServices $usuarioService;

    public function __construct(InterfaceUsuarioServices $interfaceUsuarioServices) {
        $this->middleware('auth:api');
        $this->usuarioService = $interfaceUsuarioServices;
    }


    public function store(UsuarioRequest $request)
    {
        // $usuario = new User($request->all());
        $usuario = $request->all();
        return $this->usuarioService->crearUsuario($usuario);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    public function update(UsuarioRequest $request)
    {

    }

    public function destroy(int $id)
    {
        //
    }
}
