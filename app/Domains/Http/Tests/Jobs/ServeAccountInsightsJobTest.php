<?php

namespace App\Domains\Http\Tests\Jobs;

use App\Domains\Http\Jobs\ServeAccountInsightsJob;
use Tests\TestCase;

class ServeAccountInsightsJobTest extends TestCase
{
    public function test_serve_account_insights_job()
    {
        $job = new ServeAccountInsightsJob('instagram', 'third_eye_thirst');
        $data = $job->handle();

        $this->assertEquals('{"following":1348243,"followers":445,"media_count":2234}', $data);
    }
}
