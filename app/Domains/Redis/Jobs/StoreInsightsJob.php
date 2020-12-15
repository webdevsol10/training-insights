<?php

namespace App\Domains\Redis\Jobs;

use App\Data\Models\Insights;
use App\Data\Models\Metrics;
use App\Data\Repositories\InsightsRepository;
use Lucid\Units\Job;
use Illuminate\Support\Facades\Redis;

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
     * @param InsightsRepository $insightsRepository
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        $insightsRepository = app()->make(InsightsRepository::class);

        $username = $this->insights->account->username;
        $insightsRepository->storeAccount($this->insights->account, $this->insights->platform);
        $insightsRepository->storeMedias($this->insights->medias, $this->insights->platform, $username);
        $insightsRepository->storeMediasMetrics($this->insights->medias, $this->insights->platform, $username);
    }
}
