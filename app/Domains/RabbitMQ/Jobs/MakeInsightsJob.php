<?php

namespace App\Domains\RabbitMQ\Jobs;

use App\Data\Collections\MediaCollection;
use App\Data\Models\Account;
use App\Data\Models\Insights;
use Lucid\Units\Job;

class MakeInsightsJob extends Job
{
    private string $message;

    private Account $account;

    private MediaCollection $medias;

    /**
     * Create a new job instance.
     *
     * @param string $message
     * @param Account $account
     * @param MediaCollection $medias
     */
    public function __construct(string $message, Account $account, MediaCollection $medias)
    {
        $this->message = $message;
        $this->account = $account;
        $this->medias = $medias;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): Insights
    {
        return Insights::makeFromQueueMessage((int)$this->message['fetched_at'], $this->account, $this->medias);
    }
}
