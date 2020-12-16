<?php

namespace App\Domains\Redis\Jobs;

use App\Data\Collections\MediaCollection;
use App\Data\Models\Account;
use App\Data\Models\Insights;
use App\Data\Repositories\InsightsRepository;
use Lucid\Units\Job;

class StoreAccountInsightsJob extends Job
{
    /**
     * @var string
     */
    private $platform;
    /**
     * @var Account
     */
    private $account;

    /**
     * Create a new job instance.
     *
     * @param string $platform
     * @param Account $account
     */
    public function __construct(string $platform, Account $account)
    {
        $this->platform = $platform;
        $this->account = $account;
    }

    /**
     * Execute the job.
     *
     * @param InsightsRepository $insightsRepository
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(InsightsRepository $insightsRepository)
    {
        return $insightsRepository->storeAccount($this->platform, $this->account);
    }
}
