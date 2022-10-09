<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;

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

/**
 * Unprotected Endpoints
 */

Route::controller(RegisterController::class)->group(function () {
    Route::post('login', 'login');
});

/**
 * Protected Endpoints
 */
Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('registry/{type}')->group(function () {
        Route::post('/', [App\Http\Controllers\API\RegistryController::class, 'create']);
        Route::get('/', [App\Http\Controllers\API\RegistryController::class, 'getAll']);
        Route::get('/{id}', [App\Http\Controllers\API\RegistryController::class, 'getOne']);
        Route::put('/{id}', [App\Http\Controllers\API\RegistryController::class, 'update']);
        Route::delete('/{id}', [App\Http\Controllers\API\RegistryController::class, 'delete']);
    });
    Route::prefix('type')->group(function () {
        Route::get('/', [App\Http\Controllers\API\TypeRegistryController::class, 'getAll']);
    });
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
