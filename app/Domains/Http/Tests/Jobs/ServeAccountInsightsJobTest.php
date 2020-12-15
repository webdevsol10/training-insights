<?php

namespace App\Domains\Http\Tests\Jobs;

use App\Domains\Http\Jobs\ServeAccountInsightsJob;
use Tests\TestCase;

class ServeAccountInsightsJobTest extends TestCase
{
    public function test_serve_account_insights_job()
    {

        $job = new ServeAccountInsightsJob([
            'handle' => 'asdsad',
            'platform' => 'instagram'
        ]);
        $job->handle();

    }
}
