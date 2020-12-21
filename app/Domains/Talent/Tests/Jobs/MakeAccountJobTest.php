<?php

namespace App\Domains\Talent\Tests\Jobs;

use App\Data\Models\Account;
use App\Domains\Talent\Jobs\MakeAccountJob;
use Tests\TestCase;

class MakeAccountJobTest extends TestCase
{
    public function test_make_account_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));
        $job = new MakeAccountJob($rawMessage['insights']['account']);
        $account = $job->handle();

        $this->assertEquals($account, Account::makeFromArray($rawMessage['insights']['account']));
    }
}
