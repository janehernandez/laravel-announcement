<?php

namespace App\Jobs;

use App\Models\Announcement;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateAnnouncements implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $announcements = Announcement::get();
        $now = Carbon::now();

        foreach ($announcements as $announcement) {
            $announcement->update([
                'active' => ($now >= $announcement->startDate) && ($now <= $announcement->endDate)
            ]);
        }
    }
}
