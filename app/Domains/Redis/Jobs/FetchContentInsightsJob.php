<?php

namespace App\Domains\Redis\Jobs;

use App\Data\Repositories\InsightsRepository;
use Illuminate\Support\Facades\Redis;
use Lucid\Units\Job;

class FetchContentInsightsJob extends Job
{
    private string $platform;

    private string $handle;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $platform, string $handle)
    {
        $this->platform = $platform;
        $this->handle = $handle;
    }

    /**
     * Execute the job.
     *
     * @param InsightsRepository $insightsRepository
     * @return void
     */
    public function handle(InsightsRepository $insightsRepository)
    {
        return $insightsRepository->getMedias($this->platform, $this->handle);
    }
}
