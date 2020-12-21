<?php

namespace App\Domains\Talent\Jobs;

use App\Data\Collections\MediaCollection;
use App\Data\Models\Metrics;
use Lucid\Units\Job;

class MakeMetricsJob extends Job
{
    private MediaCollection $medias;

    /**
     * Create a new job instance.
     *
     * @param MediaCollection $medias
     */
    public function __construct(MediaCollection $medias)
    {
        $this->medias = $medias;
    }

    /**
     * Execute the job.
     *
     * @return Metrics
     * @throws \Exception
     */
    public function handle()
    {
        return Metrics::makeFromMedias($this->medias);
    }
}
