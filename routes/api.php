<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PajakController;

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

   
Route::prefix('item')->group(function(){
    Route::post('create', [ItemController::class, 'store']);
    Route::get('all',[ItemController::class, 'index']);
    Route::delete('delete/{id}', [ItemController::class, 'destroy']);
    Route::post('update/{id}', [ItemController::class, 'update']);
});   

Route::prefix('pajak')->group(function(){
    Route::post('create', [PajakController::class, 'store']);
    Route::delete('delete/{id}', [PajakController::class, 'destroy']);
    Route::post('update/{id}', [PajakController::class, 'update']);
});   


