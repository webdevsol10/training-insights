<?php

namespace App\Domains\Redis\Jobs;

use App\Data\Repositories\InsightsRepository;
use Illuminate\Support\Facades\Redis;
use Lucid\Units\Job;

class FetchAccountInsightsJob extends Job
{
    private string $handle;

    private string $platform;

    /**
     * Create a new job instance.
     *
     * @param string $platform
     * @param string $handle
     */
    public function __construct(string $platform, string $handle)
    {
        $this->handle = $handle;
        $this->platform = $platform;
    }

    /**
     * Execute the job.
     *
     * @param InsightsRepository $insightsRepository
     * @return void
     */
    public function handle(InsightsRepository $insightsRepository)
    {
        // @TODO respository method
        return $insightsRepository->getAccount($this->platform, $this->handle);
    }
}
