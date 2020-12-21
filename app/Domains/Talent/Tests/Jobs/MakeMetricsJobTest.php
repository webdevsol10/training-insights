<?php

namespace App\Domains\Talent\Tests\Jobs;

use App\Data\Collections\MediaCollection;
use App\Data\Models\Metrics;
use App\Domains\Talent\Jobs\MakeMediasJob;
use App\Domains\Talent\Jobs\MakeMetricsJob;
use Tests\TestCase;

class MakeMetricsJobTest extends TestCase
{
    public function test_make_metrics_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));

        $job = new MakeMediasJob($rawMessage['insights']['content']);
        $medias = $job->handle();

        $job = new MakeMetricsJob($medias);
        $metrics = $job->handle();

        $this->assertEquals($metrics, Metrics::makeFromMedias($medias));
    }
}
