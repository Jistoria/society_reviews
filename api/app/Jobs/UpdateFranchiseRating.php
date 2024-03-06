<?php

namespace App\Jobs;

use App\Models\Franchise;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateFranchiseRating implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $franchiseId;

    /**
     * Create a new job instance.
     *
     * @param int $franchiseId
     * @return void
     */
    public function __construct($franchiseId)
    {
        $this->franchiseId = $franchiseId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $franchise = Franchise::findOrFail($this->franchiseId);
        $franchise->updateRating();
    }
}
