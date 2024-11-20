<?php

use App\Http\Controllers\Api\ApiAuthController;
use Illuminate\Support\Facades\Route;

// Public routes (no authentication required)
Route::post('/login', [ApiAuthController::class, 'login']);

// Protected routes (authentication required)
Route::middleware('auth:sanctum')->group(function () {
    // API logout
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('api.logout');
});
