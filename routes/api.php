<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::post('/register', [AuthController::class, 'register']);
route::post('/login', [AuthController::class, 'login']);
Route::middleware(['auth:sanctum','role:admin'])->group(function(){
route::post('/createpark', [ParkController::class, 'store']);
route::put('/parks/{park}', [ParkController::class, 'update']);
route::delete('/parks/{id}', [ParkController::class, 'destroy']);
});

route::middleware(['auth:sanctum'])->prefix('/v1')->group(function(){
    route::get('/parks', [ParkController::class, 'index']);

});
