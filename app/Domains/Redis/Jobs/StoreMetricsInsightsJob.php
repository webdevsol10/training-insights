<?php

namespace App\Domains\Redis\Jobs;

use App\Data\Collections\MediaCollection;
use App\Data\Models\Metrics;
use App\Data\Repositories\InsightsRepository;
use Lucid\Units\Job;

class StoreMetricsInsightsJob extends Job
{
    private string $platform;

    private string $username;

    private Metrics $metrics;

    /**
     * Create a new job instance.
     *
     * @param string $platform
     * @param string $username
     * @param Metrics $metrics
     */
    public function __construct(string $platform, string $username, Metrics $metrics)
    {
        $this->platform = $platform;
        $this->username = $username;
        $this->metrics = $metrics;
    }

    /**
     * Execute the job.
     *
     * @param InsightsRepository $insightsRepository
     * @return void
     */
    public function handle(InsightsRepository $insightsRepository)
    {
        return $insightsRepository->storeMediasMetrics($this->platform, $this->username, $this->metrics);
    }
}
