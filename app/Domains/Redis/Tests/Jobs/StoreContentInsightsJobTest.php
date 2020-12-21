<?php

namespace App\Domains\Redis\Tests\Jobs;

use App\Data\Collections\MediaCollection;
use App\Data\Repositories\InsightsRepository;
use App\Domains\Redis\Jobs\StoreContentInsightsJob;
use Tests\TestCase;

class StoreContentInsightsJobTest extends TestCase
{
    public function test_store_content_insights_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));
        $medias = MediaCollection::makeFromArray($rawMessage['insights']['content']);

        $job = new StoreContentInsightsJob('instagram','third_eye_thirst', $medias);
        $ret = $job->handle(app()->make(InsightsRepository::class));
        $this->assertTrue($ret);
    }
}
