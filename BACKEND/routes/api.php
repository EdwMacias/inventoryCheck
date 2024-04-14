<?php

use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::group(['middleware' => 'api', 'prefix' => 'user'], function ($router) {
    Route::post('create', [UsuarioController::class, 'store']);
    Route::post('update', [UsuarioController::class, 'update']);
    Route::delete('delete', [UsuarioController::class, 'destroy']);
    Route::get('get', [UsuarioController::class, 'show']);
});
