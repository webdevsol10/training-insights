<?php

namespace App\Domains\RabbitMQ\Jobs;

use App\Data\Models\Account;
use Lucid\Units\Job;

class MakeAccountJob extends Job
{
    private array $message;

    /**
     * Create a new job instance.
     *
     * @param array $message
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return Account
     */
    public function handle(): Account
    {
        return Account::makeFromArray($this->message['insights']['account']);
    }
}
