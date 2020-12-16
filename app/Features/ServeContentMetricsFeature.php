<?php

namespace App\Features;

use App\Domains\Redis\Jobs\FetchContentMetricsJob;
use Lucid\Units\Feature;
use Illuminate\Http\Request;

class ServeContentMetricsFeature extends Feature
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

    public function handle(Request $request)
    {
        return $this->run(FetchContentMetricsJob::class, [
            'handle' => $this->handle,
            'platform' => $this->platform
        ]);
    }
}
