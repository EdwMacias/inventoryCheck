<?php

use App\Http\Controllers\Item\ItemController;
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
    Route::delete('delete/{id}', [UsuarioController::class, 'destroy']);
    Route::get('get', [UsuarioController::class, 'show']);
    Route::get('get/{id}', [UsuarioController::class, 'getUsuarioId']);
});

Route::group(['prefix' => 'item'], function ($router) {
    Route::post('create', [ItemController::class, 'store']);
    Route::post('pagination', [ItemController::class, 'pagination']);
});
