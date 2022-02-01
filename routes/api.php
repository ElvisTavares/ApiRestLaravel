<?php

use App\Http\Controllers\GameController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->name('api')->group(function(){
    Route::get('/', [\App\Http\Controllers\GameController::class, 'index'])->name('game');
    Route::get('list/{id}',[GameController::class, 'show'])->name('show_game');
    Route::post('/create', [GameController::class, 'store'])->name('create_game');
    Route::put('edit/{id}', [GameController::class, 'update'])->name('update_game');
    Route::delete('delete/{id}', [GameController::class, 'destroy'])->name('delete_game');
});
