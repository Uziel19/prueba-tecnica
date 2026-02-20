<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserCardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/token', [UserController::class, 'getToken']);

Route::middleware('auth:sanctum')->prefix('users')->group(function () {

    Route::post('/', [UserController::class, 'createUser']);
    Route::put('/{id}', [UserController::class, 'updateUser']);
    Route::delete('/{id}', [UserController::class, 'deleteUser']);

    Route::post('/{id}/cards', [UserCardController::class, 'createCard']);



});
