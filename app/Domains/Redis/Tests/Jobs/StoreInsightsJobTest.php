<?php

namespace App\Domains\Redis\Tests\Jobs;

use App\Data\Models\Metrics;
use App\Domains\RabbitMQ\Jobs\ValidateQueueMessageJob;
use App\Domains\Redis\Jobs\StoreInsightsJob;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;


class StoreInsightsJobTest extends TestCase
{
    public function test_store_insights_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));
        $job = new ValidateQueueMessageJob($rawMessage);
        $insights = $job->handle();

        $job = new StoreInsightsJob($insights);
        $job->handle();

        $username = $this->insights->account->username;
        $key = `insights:{$insights->platform}:{$username}:latest:account`;
        $keyContent = Redis::get($key);


        $metrics = Metrics::makeFromMedias($this->insights->medias);


    }
}
