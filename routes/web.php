<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Authentication Routes
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

// display registration form
Route::get('/register', [RegisterController::class, 'create'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

// Custom Login Routes
Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

// landing page (index)
Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index');

// create vehicle page
Route::get('/vehicles/create', [VehicleController::class, 'create'])->name('vehicles.create');

// storing a new vehicle
Route::post('/vehicles', [VehicleController::class, 'store'])->name('vehicles.store');

// view all list of vehicle data
Route::get('/vehicles/listview', [VehicleController::class, 'listview'])->name('vehicles.listview');

// display a single vehicle data for view only
Route::get('/vehicle/{id}', [VehicleController::class, 'show'])->name('vehicles.show');

// editing a specific vehicle
Route::get('/vehicles/{vehicle}/edit', [VehicleController::class, 'edit'])->name('vehicles.edit');

// updating a specific vehicle
Route::put('/vehicles/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');

// deleting a specific vehicle
Route::delete('/vehicles/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');