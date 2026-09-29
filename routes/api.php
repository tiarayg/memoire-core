<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CapsuleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/capsules', [CapsuleController::class, 'index']);
    Route::get('/capsules/{capsule}', [CapsuleController::class, 'show']);
    Route::post('/capsules', [CapsuleController::class, 'store']);
    Route::put('/capsules/{capsule}', [CapsuleController::class, 'update']);
    Route::post('/capsules/{capsule}/seal', [CapsuleController::class, 'seal']);

    Route::post('/capsules/{capsule}/open', [CapsuleController::class, 'open']);
    
});