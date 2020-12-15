<?php

namespace App\Features;

use App\Domains\Redis\Jobs\FetchContentInsightsJob;
use Lucid\Units\Feature;

class ServeContentInsightsFeature extends Feature
{
    /**
     * @var string
     */
    private $platform;
    /**
     * @var string
     */
    private $handle;

    public function __construct(string $platform, string $handle)
    {
        $this->platform = $platform;
        $this->handle = $handle;
    }

    public function handle()
    {
        return $this->run(FetchContentInsightsJob::class, [
            'handle' => $this->handle,
            'platform' => $this->platform
        ]);
    }
}
