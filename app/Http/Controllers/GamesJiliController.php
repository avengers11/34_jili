<?php

namespace App\Http\Controllers;

// use App\Events\EventJiliGameBetInsert;
// use App\Events\EventJiliGamesUsers;

use App\Events\EventJiliGameStart;
use App\Jobs\JobJiliBet;
use App\Models\JiliBoardHistory;
use App\Models\JiliManagements;
use App\Models\JiliUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class GamesJiliController extends Controller
{
    // Test
    public function Test() {
        // return auth()->user()->email;
    }

    //index
    public function index($csrf) {
        event(new EventJiliGameStart("board1", "1234567890"));

        $vudoolive = JiliUsers::find($csrf);
        $oldUsers = JiliUsers::find($csrf);
        $user=User::find(1);

        Redis::set("user_$csrf", $oldUsers->amount);

        return view('games.jili.index')->with(compact('csrf', 'vudoolive'));
    }

    /*
    |====================
    |      ALL API
    |====================
    */
    // ManageSubmit
    public function ManageSubmit(Request $req) {
        // redis update
        $manage_redis=[
            "id"=>1,
            "run"=>(int)$req->run,
            "nextwin"=>$req->nextwin,
            "x5"=>(int)$req->x5,
            "min"=>(int)$req->min,
            "mid"=>(int)$req->mid,
            "max"=>(int)$req->max,
            "st"=>(int)$req->st,
        ];
        Redis::set('jili_manage', json_encode($manage_redis));

        // DB
        JiliManagements::where('id', 1)->update([
            "run"=>$req->run,
            "nextwin"=>$req->nextwin,
            "min"=>$req->min,
            "mid"=>$req->mid,
            "max"=>$req->max,
            "st"=>$req->st,
        ]);

        return back()->with(['st' => true, 'msg' => 'Your data successfully updated!']);
    }

    // BetInsert
    public function BetInsert(Request $req) {
        $letest=json_decode(Redis::get('jili_letest'));
        // check is it valid ?
        if(($letest->board_id) < (time()+1)){
            return response()->json(['st' => false, 'msg' => 'Timeout!']);
        }

        // amount mines
        $user_amount = Redis::get("user_$req->user_id");
        if($user_amount == null ||  $user_amount < (int)$req->amount){
            return response()->json(['st' => false, 'msg' => 'Insufficient account balance!']);
        }
        Redis::incrbyfloat("user_$req->user_id", -(int)$req->amount);

        // bet insert
        $oldArrayData = json_decode(Redis::get('jili_bet'));
        $oldArrayData[]=[
            "user_id" => $req->user_id,
            "amount" => $req->amount,
            "winner" => $req->winner
        ];
        $arrayDataJson = json_encode($oldArrayData);
        Redis::set('jili_bet', $arrayDataJson);

        // letest game
        $letest->board1=$req->winner == "board1" ? $letest->board1+$req->amount : $letest->board1;
        $letest->board2=$req->winner == "board2" ? $letest->board2+$req->amount : $letest->board2;
        $letest->board3=$req->winner == "board3" ? $letest->board3+$req->amount : $letest->board3;
        $letest->board4=$req->winner == "board4" ? $letest->board4+$req->amount : $letest->board4;
        Redis::set('jili_letest', json_encode($letest));

        // vudoolive

        // Job
        JobJiliBet::dispatch($req->user_id, $req->amount, $req->winner, $letest->board_id);

        // event
        // event(new EventJiliGameBetInsert($req->coinData));

        return response()->json(['st' => true]);
    }

    // StartGame
    public function StartGame()
    {
        $letest=json_decode(Redis::get('jili_letest'));
        if($letest == null){
            $letest=json_decode(JiliBoardHistory::orderBy('id', 'DESC')->first());
            Redis::set('jili_letest', json_encode($letest));
        }
        return response()->json(['data' => $letest]);
    }

    // AmountShow
    public function AmountShow(Request $req)
    {
        return response()->json(['amount' => json_decode(Redis::get("user_$req->id"))]);
    }

    // BetHistory
    public function BetHistory()
    {
        return response()->json(['data' => JiliBoardHistory::orderBy('id', 'DESC')->where('st', 1)->take(30)->get()]);
    }

}
