<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\APIV1\Flower\Controllers\FlowerController;
use App\Http\APIV1\Room\Controllers\RoomController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/flowers', [FlowerController::class, 'create']);
Route::delete('/flowers/{id}', [FlowerController::class, 'delete']);
Route::get('/flowers', [FlowerController::class, 'getAll']);
Route::get('/flowers/{id}', [FlowerController::class, 'getById']);
Route::put('/flowers/{id}', [FlowerController::class, 'update']);
Route::patch('/flowers/{id}', [FlowerController::class, 'updateFields']);
Route::post('/flowers/{id}/water', [FlowerController::class, 'water']);
Route::get('/rooms', [RoomController::class, 'getAll']);
