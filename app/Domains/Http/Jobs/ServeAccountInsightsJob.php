<?php

namespace App\Domains\Http\Jobs;

use Illuminate\Support\Facades\Redis;
use Lucid\Units\Job;

class ServeAccountInsightsJob extends Job
{
    private $handle;
    /**
     * @var string
     */
    private $platform;

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
        $key = "insights:{$this->platform}:{$this->handle}:latest:account";
        return Redis::get($key) ?? '';
    }
}
