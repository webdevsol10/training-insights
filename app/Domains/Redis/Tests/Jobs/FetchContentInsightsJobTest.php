<?php

namespace App\Domains\Redis\Tests\Jobs;

use App\Domains\Redis\Jobs\FetchContentInsightsJob;
use Tests\TestCase;

class FetchContentInsightsJobTest extends TestCase
{
    public function test_fetch_content_insights_job()
    {
        $job = new FetchContentInsightsJob('instagram', 'third_eye_thirst');
        $data = $job->handle();

        $content = file_get_contents(base_path('/tests/resources/content.json'));
        $this->assertEquals($content, $data);
    }
}
