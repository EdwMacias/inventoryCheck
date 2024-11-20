<?php

use App\Http\Controllers\Item\ItemController;
use App\Http\Controllers\Item\ItemObservationController;
use App\Http\Controllers\Pqrs\PqrsController;
use App\Http\Controllers\Role\RolesUserController;
use App\Http\Controllers\Terceros\TercerosController;
use App\Http\Controllers\Usuario\UsuarioController;
use App\Http\Controllers\Authentication\AuthController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'api', 'prefix' => 'recovery'], function () {
    Route::get('code/temporary/{email}', [UsuarioController::class, 'getCodeTemporal']);
    Route::get('password/code/authenticacion', [UsuarioController::class, 'authenticacionCode']);
    Route::post('password/{code}', [UsuarioController::class, 'updatePassword']);
});

Route::group(['middleware' => 'api', 'prefix' => 'user'], function () {
    Route::post('create', [UsuarioController::class, 'store']);
    Route::post('update/{id}', [UsuarioController::class, 'update']);
    Route::put('inactivar/{id}', [UsuarioController::class, 'inactivar']);
    Route::put('activar/{id}', [UsuarioController::class, 'activar']);
    Route::get('all', [UsuarioController::class, 'show']);
    Route::get('{id}', [UsuarioController::class, 'getUsuarioId']);
});

Route::group(['middleware' => 'api', 'prefix' => 'item'], function () {
    Route::get('', [ItemController::class, 'pagination']);
    Route::delete('{id}', [ItemController::class, 'destroy']);

    Route::group(['prefix' => 'equipo'], function () {
        Route::post('', [ItemController::class, 'createEquipo']);
        Route::post('/add/repair/{id}', [ItemController::class, 'addRepairItemEquipo']);
    });

    Route::group(['prefix' => 'basico'], function () {
        Route::post('', [ItemController::class, 'store']);
    });

    Route::group(['prefix' => 'observacion'], function () {
        Route::group(['prefix' => 'equipo'], function () {
            Route::post('', [ItemObservationController::class, 'createObservacionEquipo']);
            Route::get('{id}', [ItemObservationController::class, 'getObservacionesEquipo']);
        });
        Route::group(['prefix' => 'oficina'], function () {
            Route::post('', [ItemObservationController::class, 'createObservacionItemBasico']);
            Route::get('{id}', [ItemObservationController::class, 'getObservacionItemBasico']);
        });
    });
});

Route::group(['middleware' => 'api', 'prefix' => 'role'], function () {
    // Route::get('', [RolesUserController::class, 'get']);
    Route::post('', [RolesUserController::class, 'assign']);
    Route::delete('{id}', [RolesUserController::class, 'unassign']);
    Route::get('', [RolesUserController::class, 'getRoleUsuario']);
    Route::get('{id}', [RolesUserController::class, 'getRoleUsuarioByEmail']);
});

Route::group(['middleware' => 'api', "prefix" => "pqrs"], function () {
    Route::post('', [PqrsController::class, 'store']);
    Route::get('', [PqrsController::class, 'show']);
});


Route::group(['middleware' => 'api', 'prefix' => 'tercero'], function () {
    Route::post('', [TercerosController::class, 'store']);
    Route::get('', [TercerosController::class, 'show']);
});