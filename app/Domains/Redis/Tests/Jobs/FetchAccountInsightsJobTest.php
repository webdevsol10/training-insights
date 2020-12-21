<?php

namespace App\Domains\Redis\Tests\Jobs;

use App\Data\Repositories\InsightsRepository;
use App\Domains\Redis\Jobs\FetchAccountInsightsJob;
use Tests\TestCase;

class FetchAccountInsightsJobTest extends TestCase
{
    public function test_serve_account_insights_job()
    {
        $job = new FetchAccountInsightsJob('instagram', 'third_eye_thirst');
        $data = $job->handle(app()->make(InsightsRepository::class));

        $this->assertEquals('{"following":1348243,"followers":445,"media_count":2234}', $data);
    }
}
