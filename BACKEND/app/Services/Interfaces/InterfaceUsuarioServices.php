<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface InterfaceUsuarioServices
{
    public function crearUsuario($UserModel);
    public function actualizarUsuario($id, $usuarioArray);
    public function eliminarUsuario($id);
    public function obtenerUsuarios();
}
