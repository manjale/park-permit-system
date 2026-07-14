<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ParkController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermitController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\FeeRuleController;
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
     route::post('/payment', [PaymentController::class, 'store']);
     route::post('/permits', [PermitController::class, 'store']);


});
route::middleware(['auth:sanctum','role:service_officer'])->prefix('/v1')->group(function(){
    route::post('/permits/{permit}/verify', [PermitController::class, 'verify']);
    Route::post('/entries', [EntryController::class, 'store']);
     //route::post('/payment', [PemitController::class, 'approve']);


});
route::middleware(['auth:sanctum','role:admin'])->prefix('/v1')->group(function(){
    route::patch('/permits/{permit}/approve', [PermitController::class, 'approve']);
     route::patch('/permits/{permit}/reject', [PermitController::class, 'reject']);
     route::get('/permits/state', [PermitController::class, 'index']);
     route::get('/feerule', [FeeRuleController::class, 'index']);
     route::post('/feerule/create', [FeeRuleController::class, 'store']);



});

