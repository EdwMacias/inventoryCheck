<?php

namespace App\Services\Interfaces;

use App\Models\User;
use App\Utils\ResponseHandler;

interface InterfaceUsuarioServices
{
    public function crearUsuario($UserModel) : ResponseHandler;
    public function actualizarUsuario($id,array $usuario) :ResponseHandler ;
    public function eliminarUsuario($id);
    public function obtenerUsuarios();
}
