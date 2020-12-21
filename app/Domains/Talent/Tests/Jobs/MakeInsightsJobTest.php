<?php

namespace App\Domains\Talent\Tests\Jobs;

use App\Data\Models\Account;
use App\Data\Models\Insights;
use App\Domains\Talent\Jobs\MakeAccountJob;
use App\Domains\Talent\Jobs\MakeInsightsJob;
use App\Domains\Talent\Jobs\MakeMediasJob;
use Tests\TestCase;

class MakeInsightsJobTest extends TestCase
{
    public function test_make_insights_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));

        $j = new MakeAccountJob($rawMessage['insights']['account']);
        $account = $j->handle();

        $j = new MakeMediasJob($rawMessage['insights']['content']);
        $medias = $j->handle();

        $j = new MakeInsightsJob((int)$rawMessage['fetched_at'], $account, $medias);
        $insights = $j->handle();

        $testInsights = Insights::makeFromAccountAndMedia((int)$rawMessage['fetched_at'], $account, $medias);
        $this->assertEquals($insights, $testInsights);
    }
}
