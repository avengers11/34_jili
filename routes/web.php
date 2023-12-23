<?php

use App\Events\EventJiliGameStart;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GamesJiliController;
use Illuminate\Support\Facades\Redis;

// admin
use App\Http\Controllers\Admin\AdminDeshboardController;
use App\Http\Controllers\Admin\AdminJiliGamesController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// all games
Route::get('/{csrf}', [GamesJiliController::class, 'index']) -> name('index');
Route::group(['prefix' => 'jili'], function(){
    Route::get('/test', [GamesJiliController::class, 'Test']) -> name('Test');
    Route::get('/{csrf}', [GamesJiliController::class, 'index']) -> name('index');
});

Route::get('/redis', function(){
    // Redis::get('user_1', 10000);
    return response()->json(['amount' => json_decode(Redis::get('user_1')), 'jili_bet' => json_decode(Redis::get('jili_bet')), "jili_letest" => json_decode(Redis::get('jili_letest')), "jili_manage" => json_decode(Redis::get('jili_manage'))]);
});


Route::get('/welcome', function () {
    // return view('welcome');
   echo Hash::make("12345678");
});


/*

|========================
|       ADMIN
|========================
*/
Route::group(['prefix'=>'admin'],function(){
    // deshboard
    Route::get('/', [AdminDeshboardController::class, 'AdminIndex']) -> name('AdminIndex');

    // JILI
    Route::prefix('jili')->group(function(){
        Route::get('/settings', [AdminJiliGamesController::class, 'AdminJiliSettings']) -> name('jili.AdminSettings');
        Route::get('/history', [AdminJiliGamesController::class, 'AdminJiliHistory']) -> name('jili.AdminHistory');
    });

});
