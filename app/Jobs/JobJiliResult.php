<?php

namespace App\Jobs;

use App\Events\EventJiliGameWinner;
use App\Models\JiliBetInsert;
use App\Models\JiliBoardHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class JobJiliResult implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $winner;
    public $winrate;
    public $time;
    public function __construct($winner, $winrate, $time)
    {
        $this->winner=$winner;
        $this->winrate=$winrate;
        $this->time=$time;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $winner=DB::table('jili_bet_inserts')
                ->join("jili_users",  "jili_bet_inserts.user_id", "=", "jili_users.user_id")
                ->select(
                    "jili_users.name as name",
                    "jili_users.img as img",
                    "jili_bet_inserts.user_id",
                    DB::raw("SUM(jili_bet_inserts.amount*$this->winrate) as tranction_amount"),
                    DB::raw("'Jili games win rate ".$this->winrate."X' as 'info'"),
                )
                ->groupBy('jili_bet_inserts.user_id', 'jili_users.name', 'jili_users.img')
                ->where('jili_bet_inserts.board_id', $this->time)
                ->where('jili_bet_inserts.winner', $this->winner)
                ->get();

        // Change st
        JiliBetInsert::where('board_id', $this->time)->update(["st" => 1]);

        event(new EventJiliGameWinner($winner, $this->winner));
    }
}
