<?php

namespace App\Domains\Redis\Jobs;

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
     * @return void
     */
    public function handle()
    {
        // @TODO respository method
        $key = "insights:{$this->platform}:{$this->handle}:latest:account";
        return Redis::get($key) ?? '';
    }
}