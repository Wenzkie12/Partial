<?php

namespace App\Jobs;

use App\Models\ToReturnList;
use App\Models\User;
use App\Models\Penalty;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;

class ApplyPenaltyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $item;

    public function __construct(ToReturnList $item)
    {
        $this->item = $item;
    }

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
                // Add penalty to user's total penalty column
                $user->increment('penalty', 5.00);

                // Record penalty in `penalties` table
                Penalty::create([
                    'user_id' => $user->id,
                    'book_id' => $item->book_id,
                    'amount' => 5.00,
                    'applied_at' => now(),
                ]);
            }

            // Re-dispatch the job to run again in one minute
            self::dispatch($item)->delay(now()->addMinute());
        }
    }
}
