<?php

namespace App\Domains\Redis\Jobs;

use Illuminate\Support\Facades\Redis;
use Lucid\Units\Job;

class FetchContentMetricsJob extends Job
{
    private string $platform;

    private string $handle;

    /**
     * Create a new job instance.
     *
     * @param string $platform
     * @param string $handle
     */
    public function __construct(string $platform, string $handle)
    {
        $this->platform = $platform;
        $this->handle = $handle;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // @TODO respository method
        $key = "insights:{$this->platform}:{$this->handle}:content:metrics";
        return Redis::get($key) ?? '';
    }
}
