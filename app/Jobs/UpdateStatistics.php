<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\{Statistic, Task};

class UpdateStatistics implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  /**
   * Create a new job instance.
   */
  protected $userId;
  public function __construct($userId)
  {
    //
    $this->userId = $userId;
  }

  /**
   * Execute the job.
   */
  public function handle(): void
  {

    $statistic = Statistic::where('user_id', $this->userId)->first();

        if ($statistic) {
            $statistic->increment('task_count');
        } else {
            Statistic::create([
                'user_id' => $this->userId,
                'task_count' => 1
            ]);
        }
    }
}
