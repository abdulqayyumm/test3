<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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

Route::group([
    'namespace' => 'App\Http\Controllers\Api',
    'prefix' => 'v1'
], function ($router) {
    Route::group(['prefix' => 'users'], function ($router) {
        Route::get('', [UserController::class, 'index']);
        Route::post('', [UserController::class, 'store']);
        Route::put('{id}', [UserController::class, 'update']);
        Route::delete('{id}', [UserController::class, 'destroy']);
        Route::get('export', [UserController::class, 'exportUsers']);
        Route::post('fetch/save', [UserController::class, 'fetchAndSaveUser']);
        Route::get('{id}', [UserController::class, 'show']);
    });
});