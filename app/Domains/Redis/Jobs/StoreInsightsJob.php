<?php

namespace App\Domains\Redis\Jobs;

use App\Data\Models\Insights;
use Lucid\Units\Job;

class StoreInsightsJob extends Job
{
    /**
     * @var Insights
     */
    private Insights $insights;

    /**
     * Create a new job instance.
     *
     * @param Insights $insights
     */
    public function __construct(Insights $insights)
    {
        $this->insights = $insights;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        //insights:{platform}:{username}:latest:account
        //insights:{platform}:{username}:latest:content

    }
}
