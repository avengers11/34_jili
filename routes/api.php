<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesJiliController;
use Illuminate\Support\Facades\Broadcast;

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

// all games
Route::group(['prefix' => 'jili'], function(){
    Route::POST('/manage-submit', [GamesJiliController::class, 'ManageSubmit']) -> name('ManageSubmit');
    Route::POST('/start-game', [GamesJiliController::class, 'StartGame']) -> name('StartGame');
    Route::POST('/bet-insert', [GamesJiliController::class, 'BetInsert']) -> name('BetInsert');
    Route::POST('/amount-show', [GamesJiliController::class, 'AmountShow']) -> name('AmountShow');
    Route::POST('/bet-history', [GamesJiliController::class, 'BetHistory']) -> name('BetHistory');
});


