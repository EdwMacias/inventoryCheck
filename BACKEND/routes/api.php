<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'api', 'prefix' => 'usuario'], function ($router) {
    Route::post('crear', [UsuarioController::class, 'store']);
    Route::post('update', [UsuarioController::class, 'update']);
    Route::post('delete', [UsuarioController::class, 'destroy']);
    Route::post('obtener', [UsuarioController::class, 'show']);
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('invetario/item/crear', [AuthController::class, 'store']);
    Route::post('invetario/item/update', [AuthController::class, 'update']);
    Route::post('invetario/item/delete', [AuthController::class, 'destroy']);
    Route::post('invetario/item/delete', [AuthController::class, 'show']);
});