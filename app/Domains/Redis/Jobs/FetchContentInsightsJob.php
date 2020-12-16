<?php

namespace App\Domains\Redis\Jobs;

use Illuminate\Support\Facades\Redis;
use Lucid\Units\Job;

class FetchContentInsightsJob extends Job
{
    /**
     * @var string
     */
    private $platform;
    /**
     * @var string
     */
    private $handle;

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
     * @return void
     */
    public function handle()
    {
        // @TODO respository method
        $key = "insights:{$this->platform}:{$this->handle}:latest:content";
        return Redis::get($key) ?? '';
    }
}
