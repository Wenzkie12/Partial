<?php

namespace App\Jobs;

use App\Models\ToReturnList;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class ApplyPenaltyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $item;

    /**
     * Create a new job instance.
     */
    public function __construct(ToReturnList $item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $item = ToReturnList::find($this->item->id);

        if (!$item || $item->returned_at) {
            return; 
        }

        $now = Carbon::now();
        $claimedAt = Carbon::parse($item->claimed_at);

        if ($claimedAt->addMinute()->lessThanOrEqualTo($now)) {
          
            $user = User::find($item->user_id);

            if ($user) {
                $user->increment('penalty', 5.00);
            }

    
            self::dispatch($item)->delay(now()->addMinute());
        }
    }
}
