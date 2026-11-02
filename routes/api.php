<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\TreeController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // Rutas públicas
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Rutas protegidas
    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout']);

        Route::get('/trees', [TreeController::class, 'index']);
        Route::get('/trees/{tree}', [TreeController::class, 'show']);
        Route::post('/trees', [TreeController::class, 'store']);

        Route::put('/trees/{tree}', [TreeController::class, 'update']);
        Route::patch('/trees/{tree}', [TreeController::class, 'update']);

        Route::post('/trees/{tree}/care', [TreeController::class, 'care']);
    });
});