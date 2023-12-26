<?php

namespace App\Jobs;

use App\Models\JiliBetInsert;
use App\Models\JiliBoardHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class JobJiliBet implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $user_id;
    public $amount;
    public $winner;
    public $board_id;
    public function __construct($user_id, $amount, $winner, $board_id)
    {
        $this->user_id=$user_id;
        $this->amount=$amount;
        $this->winner=$winner;
        $this->board_id=$board_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // bet insert
        $db = new JiliBetInsert;
        $db->board_id=$this->board_id;
        $db->user_id=$this->user_id;
        $db->amount=$this->amount;
        $db->winner=$this->winner;
        $db->st=0;
        $db->save();

        // // database insert
        // $oldData = JiliBoardHistory::where('board_id', $this->board_id)->first();
        // JiliBoardHistory::where('board_id', $this->board_id)->update([
        //     "board1"=>$this->winner=="board1" ? $this->amount+$oldData->board1 : $oldData->board1,
        //     "board2"=>$this->winner=="board2" ? $this->amount+$oldData->board2 : $oldData->board2,
        //     "board3"=>$this->winner=="board3" ? $this->amount+$oldData->board3 : $oldData->board3,
        //     "board4"=>$this->winner=="board4" ? $this->amount+$oldData->board4 : $oldData->board4,
        // ]);
    }
}
