<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\VehicleControllerAPI;

Route::middleware('api')->group(function () {
    // Get all vehicles (with optional filters)
    Route::get('/vehicles', [VehicleControllerAPI::class, 'indexApi']);
    
    // Get a single vehicle by ID
    Route::get('/vehicle/{id}', [VehicleControllerAPI::class, 'showApi']);
    
    // Store a new vehicle (POST request)
    Route::post('/vehicles', [VehicleControllerAPI::class, 'storeApi']);
    
    // Update a specific vehicle (PUT/PATCH request)
    Route::put('/vehicles/{id}', [VehicleControllerAPI::class, 'updateApi']);
    
    // Delete a specific vehicle (DELETE request)
    Route::delete('/vehicles/{id}', [VehicleControllerAPI::class, 'destroyApi']);
});
