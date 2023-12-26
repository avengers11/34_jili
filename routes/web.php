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
// Route::get('/{csrf}', [GamesJiliController::class, 'index']) -> name('index');
Route::group(['prefix' => 'jili'], function(){
    Route::get('/test', [GamesJiliController::class, 'Test']) -> name('Test');
    Route::get('/{csrf}', [GamesJiliController::class, 'index']) -> name('index');
});

Route::get('/redis', function(){
    return response()->json(['amount' => json_decode(Redis::get('user_1')), 'jili_bet' => json_decode(Redis::get('jili_bet')), "jili_letest" => json_decode(Redis::get('jili_letest')), "jili_manage" => json_decode(Redis::get('jili_manage'))]);
});


Route::get('/test', function () {

    // $jsonData = Redis::get('jili_bet');
    // // Decode the JSON data into an array of stdClass objects
    // $decodedData = json_decode($jsonData);

    // $filteredData = array_filter($decodedData, function ($entry) use ($userID) {
    //     return $entry->user_id === $userID && $entry->winner === 'board2';
    // });

    // $now_bet = json_decode(Redis::get('jili_bet'));
    // return $decodedData->where('user_id', 1)->get();
    // return $now_bet;


    // Retrieve the JSON data from Redis
    $jsonData = Redis::get('jili_bet');

    // Decode the JSON data into an array of objects
    $decodedData = json_decode($jsonData);

    // Group the data by user_id and winner
    $groupedData = [];
    foreach ($decodedData as $entry) {
        $groupKey = $entry->user_id . '_' . $entry->winner;

        if (!isset($groupedData[$groupKey])) {
            $groupedData[$groupKey] = [];
        }

        $groupedData[$groupKey][] = $entry;
    }

    return $groupedData;
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
