<?php

namespace App\Services\Interfaces;

use App\DTOs\Usuario\UsuarioCreateDTO;
use App\Models\User;
use App\Utils\ResponseHandler;
use Illuminate\Http\JsonResponse;

interface InterfaceUsuarioServices
{

  /**
   * Crear Usuario
   * @param UsuarioCreateDTO $usuarioCreateDTO
   * Dto de usuario a crear
   * @return JsonResponse
   */
  public function crearUsuario(UsuarioCreateDTO $usuarioCreateDTO): JsonResponse;
  
  /**
   * Actualizar usuario
   * @param string $userId
   * Id del usuario a actualizar
   * @param UsuarioCreateDTO $usuarioCreateDTO
   * Datos del usuario a actualizar
   */
  public function actualizarUsuario(string $userId, UsuarioCreateDTO $usuarioCreateDTO): JsonResponse;
  
  /**
   * Inactivar usuario por ID
   * @param string $userId
   * Id del usuario a inactivar
   * @return \Illuminate\Http\JsonResponse
   */
  public function inactivar(string $userId): JsonResponse;
  
  /**
   * Activar usuario por id
   * @param string $userId
   * Id del usuario a activar
   * @return \Illuminate\Http\JsonResponse
   */
  public function activar(string $userId): JsonResponse;
  
  /**
   * metodo para retornar los usuarios
   */
  public function obtenerUsuarios();
  
  /**
   *Cambiar contraseña del usuario
   * @param string $code
   * codigo recibido del usuario
   * @param array $usuario
   * @return ResponseHandler
   */
  public function updatePassword($code, array $usuario);

  /**
   * Recuperar usaurio por el id
   * @param string $userId
   * Id del usuario a buscar
   * @return JsonResponse
   */
  public function obtenerUsuarioId($userId): JsonResponse;
}
