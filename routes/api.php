<?php

use App\Http\Controllers\API\CardController;
use App\Http\Controllers\API\ListController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix' => 'projects'], function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::post('/', [ProjectController::class, 'store']);
        Route::get('/{id}/lists', [ListController::class, 'index']);
        Route::post('/{id}/lists', [ListController::class, 'store']);
    });
    Route::group(['prefix' => 'cards'], function () {
        Route::post('/', [CardController::class, 'store']);
        Route::group(['prefix' => '{id}/timer'], function () {
            Route::post('/on', [CardController::class, 'timerOn']);
            Route::post('/off', [CardController::class, 'timerOff']);
        });
    });
});
