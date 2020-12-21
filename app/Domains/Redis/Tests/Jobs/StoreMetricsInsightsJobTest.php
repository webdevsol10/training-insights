<?php

namespace App\Domains\Redis\Tests\Jobs;

use App\Data\Collections\MediaCollection;
use App\Data\Models\Metrics;
use App\Data\Repositories\InsightsRepository;
use App\Domains\Redis\Jobs\StoreContentInsightsJob;
use App\Domains\Redis\Jobs\StoreMetricsInsightsJob;
use Tests\TestCase;

class StoreMetricsInsightsJobTest extends TestCase
{
    public function test_store_metrics_insights_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));
        $medias = MediaCollection::makeFromArray($rawMessage['insights']['content']);

        $metrics = Metrics::makeFromMedias($medias);
        $job = new StoreMetricsInsightsJob('instagram','third_eye_thirst', $metrics);
        $ret = $job->handle(app()->make(InsightsRepository::class));
        $this->assertTrue($ret);
    }
}
