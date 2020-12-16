<?php

namespace App\Domains\Redis\Tests\Jobs;

use App\Domains\Redis\Jobs\FetchContentInsightsJob;
use App\Domains\Redis\Jobs\FetchContentMetricsJob;
use Tests\TestCase;

class FetchContentMetricsJobTest extends TestCase
{
    public function test_fetch_content_metrics_job()
    {
        $job = new FetchContentMetricsJob('instagram', 'third_eye_thirst');
        $data = $job->handle();

        $content = file_get_contents(base_path('/tests/resources/metrics.json'));
        $this->assertEquals($content, $data);
    }
}
