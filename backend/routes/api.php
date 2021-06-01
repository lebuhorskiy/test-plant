<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantsController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\ProtectionProductsController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::prefix('plants')->group(function () {
    Route::get('/', [PlantsController::class, 'get']);
    Route::post('/add', [PlantsController::class, 'create']);
    Route::get('/types', [TypesController::class, 'get']);
    Route::get('/protection-products', [ProtectionProductsController::class, 'get']);
});
Route::prefix('plant')->group(function () {
    Route::get('/', [PlantsController::class, 'find']);
    Route::delete('/', [PlantsController::class, 'delete']);
    Route::put('/', [PlantsController::class, 'update']);
});