<?php

namespace App\Domains\Talent\Jobs;

use App\Data\Models\Account;
use Lucid\Units\Job;

class MakeAccountJob extends Job
{
    private array $account;

    /**
     * Create a new job instance.
     *
     * @param array $account
     */
    public function __construct(array $account)
    {
        $this->account = $account;
    }

    /**
     * Execute the job.
     *
     * @return Account
     */
    public function handle(): Account
    {
        return Account::makeFromArray($this->account);
    }
}
