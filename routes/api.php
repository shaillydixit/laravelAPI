<?php

use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('list-employees', [ApiController::class, 'listEmolpyees']);

Route::get('sinlge-employee/{id}', [ApiController::class, 'getSingleEmolpyee']);

Route::get('add-employee', [ApiController::class, 'createEmolpyee']);

Route::put('update-employee/{id}', [ApiController::class, 'updateEmolpyee']);

Route::delete('delete-employee/{id}', [ApiController::class, 'deleteEmolpyee']);
