<?php

namespace App\Services\Interfaces;

use App\Models\User;
use App\Utils\ResponseHandler;

interface InterfaceUsuarioServices
{
  public function crearUsuario($UserModel);
  public function actualizarUsuario($id, array $usuario): ResponseHandler;
  public function eliminarUsuario($id);
  public function obtenerUsuarios();

  /**
   *
   * @param string $id
   * @param array $usuario
   * @return ResponseHandler
   */
  public function updatePassword($id, array $usuario);

  public function obtenerUsuarioId($id): ResponseHandler;
}
