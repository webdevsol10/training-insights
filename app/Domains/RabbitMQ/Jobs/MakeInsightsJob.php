<?php

namespace App\Domains\RabbitMQ\Jobs;

use App\Data\Collections\MediaCollection;
use App\Data\Models\Account;
use App\Data\Models\Insights;
use Lucid\Units\Job;

class MakeInsightsJob extends Job
{
    private Account $account;

    private MediaCollection $medias;

    private int $fetchedAt;

    /**
     * Create a new job instance.
     *
     * @param int $fetchedAt
     * @param Account $account
     * @param MediaCollection $medias
     */
    public function __construct(int $fetchedAt, Account $account, MediaCollection $medias)
    {
        $this->account = $account;
        $this->medias = $medias;
        $this->fetchedAt = $fetchedAt;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): Insights
    {
        return Insights::makeFromAccountAndMedia($this->fetchedAt, $this->account, $this->medias);
    }
}
