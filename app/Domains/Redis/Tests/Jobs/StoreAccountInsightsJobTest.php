<?php

namespace App\Domains\Redis\Tests\Jobs;

use App\Data\Models\Account;
use App\Data\Repositories\InsightsRepository;
use App\Domains\Redis\Jobs\StoreAccountInsightsJob;
use Tests\TestCase;

class StoreAccountInsightsJobTest extends TestCase
{
    public function test_store_account_insights_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));
        $account = Account::makeFromArray($rawMessage['insights']['account']);

        $job = new StoreAccountInsightsJob('instagram', $account);
        $ret = $job->handle(new InsightsRepository());
        $this->assertTrue($ret);
    }
}
