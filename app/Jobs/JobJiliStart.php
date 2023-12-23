<?php

namespace App\Jobs;

use App\Models\JiliBoardHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class JobJiliStart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $winner;
    public $board_id;
    public $old_board_id;
    public function __construct($winner, $board_id, $old_board_id)
    {
        $this->winner=$winner;
        $this->board_id=$board_id;
        $this->old_board_id=$old_board_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        JiliBoardHistory::where('board_id', $this->old_board_id)->update([
            'winner' => $this->winner,
            'st' => 1
        ]);

        $history=new JiliBoardHistory;
        $history->board_id=$this->board_id;
        $history->winner="unknown";
        $history->save();
    }
}
