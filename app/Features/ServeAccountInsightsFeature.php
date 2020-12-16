<?php

namespace App\Features;

use App\Domains\Redis\Jobs\FetchAccountInsightsJob;
use Lucid\Units\Feature;
use Illuminate\Http\Request;

class ServeAccountInsightsFeature extends Feature
{
    private $handle;
    /**
     * @var string
     */
    private $platform;

    public function __construct(string $platform, string $handle)
    {
        $this->handle = $handle;
        $this->platform = $platform;
    }

    public function handle()
    {
        return $this->run(FetchAccountInsightsJob::class, [
            'handle' => $this->handle,
            'platform' => $this->platform
        ]);
    }
}
