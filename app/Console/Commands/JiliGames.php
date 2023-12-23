<?php

namespace App\Console\Commands;

use App\Events\EventJiliGameStart;
use App\Jobs\JobJiliResult;
use App\Jobs\JobJiliStart;
use App\Models\JiliBoardHistory;
use App\Models\JiliManagements;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class JiliGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:jili-games';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Jili games cmd';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // manage data
        $manageData=json_decode(Redis::get('jili_manage'));
        if($manageData == null){
            $manageData=json_decode(JiliManagements::find(1));
            Redis::set('jili_manage', json_encode($manageData));
        }

        // status
        if($manageData->st == 0){
            return false;
        }

        // letest game
        $letest=json_decode(Redis::get('jili_letest'));
        if($letest == null){
            $letest=json_decode(JiliBoardHistory::orderBy('id', 'DESC')->first());
            Redis::set('jili_letest', json_encode($letest));
        }

        // Winner Express
        $winner = "";
        $winrate = 0;
        $random = rand(0, 1000);
        $test = "menuall";
        if($manageData->run == 1){
            $arrayData = [
                "board1" => $letest->board1,
                "board2" => $letest->board2,
                "board3" => $letest->board3,
            ];
            if($letest->board1 == $letest->board2 && $letest->board2 == $letest->board3){
                $random_array = array("board1", "board2", "board3");
                $winner = $random_array[array_rand($random_array)];
                $winrate = 3;
                $test = "random";
            }else if($random <= $manageData->x5){
                $winner = "board4";
                $winrate = 5;
                $test = "x5";
            }else if($random > $manageData->x5 && $random <= $manageData->min){
                $winner = array_keys($arrayData, min($arrayData))[0];
                $winrate = 3;
                $test = "min";
            }else if($random > $manageData->min && $random <= $manageData->mid){
                asort($arrayData);
                $winner = array_keys($arrayData)[1];
                $winrate = 3;
                $test = "mid";
            }else{
                $winner = array_keys($arrayData, max($arrayData))[0];
                $winrate = 3;
                $test = "max";
            }
        }else{
            $winner = $manageData->nextwin;
            if($manageData->nextwin == "board4"){
                $winrate = 5;
            }else{
                $winrate = 3;
            }
        }

        // Redis Bet Update
        $letestBet = json_decode(Redis::get('jili_bet')) == null ? array() : json_decode(Redis::get('jili_bet'));
        foreach ($letestBet as $key => $value) {
            if($value->winner == $winner){
                Redis::incrbyfloat("user_$value->user_id", (int)($value->amount*$winrate));
            }
        }
        Redis::set('jili_bet', json_encode([]));

        // Result
        $time = time()+30;
        JobJiliResult::dispatch($winner, $winrate, $letest->board_id);

        // New Start
        $letestNew=[
            "board_id" => $time,
            "board1" => 0,
            "board2" => 0,
            "board3" => 0,
            "board4" => 0,
            "winner" => $random."-".$test,
            "st" => 0,
        ];
        Redis::set('jili_letest', json_encode($letestNew));
        JobJiliStart::dispatch($winner, $time, $letest->board_id);

        event(new EventJiliGameStart($winner, $time));
    }
}
