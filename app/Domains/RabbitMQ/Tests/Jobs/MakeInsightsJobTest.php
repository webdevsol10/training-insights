<?php

namespace App\Domains\RabbitMQ\Tests\Jobs;

use App\Data\Models\Account;
use App\Data\Models\Insights;
use App\Domains\RabbitMQ\Jobs\MakeAccountJob;
use App\Domains\RabbitMQ\Jobs\MakeInsightsJob;
use App\Domains\RabbitMQ\Jobs\MakeMediasJob;
use Tests\TestCase;

class MakeInsightsJobTest extends TestCase
{
    public function test_make_insights_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));

        $j = new MakeAccountJob($rawMessage);
        $account = $j->handle();

        $j = new MakeMediasJob($rawMessage);
        $medias = $j->handle();

        $j = new MakeInsightsJob($rawMessage, $account, $medias);
        $insights = $j->handle();

        $testInsights = Insights::makeFromQueueMessage((int)$rawMessage['fetched_at'], $account, $medias);
        $this->assertEquals($insights, $testInsights);
    }
}
