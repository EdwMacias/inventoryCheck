<?php

use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Item\ItemObservationController;
use App\Http\Controllers\Role\RolesUserController;
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Authentication\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'api', 'prefix' => 'recovery'], function ($router) {
    Route::get('code/temporary/{email}', [UsuarioController::class, 'getCodeTemporal']);
    Route::get('password/code/authenticacion', [UsuarioController::class, 'authenticacionCode']);
    Route::post('password/{code}', [UsuarioController::class, 'updatePassword']);
});

Route::group(['middleware' => 'api', 'prefix' => 'user'], function ($router) {
    Route::post('create', [UsuarioController::class, 'store']);
    Route::post('update/{id}', [UsuarioController::class, 'update']);
    Route::put('inactivar/{id}', [UsuarioController::class, 'inactivar']);
    Route::put('activar/{id}', [UsuarioController::class, 'activar']);
    Route::get('all', [UsuarioController::class, 'show']);
    Route::get('{id}', [UsuarioController::class, 'getUsuarioId']);
});

Route::group(['prefix' => 'item'], function ($router) {
    Route::post('create', [ItemController::class, 'store']);
    Route::get('pagination', [ItemController::class, 'pagination']);

    Route::group(['prefix' => 'observation'], function ($router) {
        Route::post('create', [ItemObservationController::class, 'store']);
        Route::post('update/{id}', [ItemObservationController::class, 'update']);
    });
});

Route::group(['prefix' => 'role'], function ($router) {
    Route::get('roles',[RolesUserController::class,'get']);
    Route::post('assing', [RolesUserController::class, 'assing']);
    Route::delete('unassign/{id}', [RolesUserController::class, 'unassign']);
    Route::get('/get', [RolesUserController::class, 'getRoleUsuario']);
});
