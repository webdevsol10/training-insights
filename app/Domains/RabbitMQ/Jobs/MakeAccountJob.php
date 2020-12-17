<?php

namespace App\Domains\RabbitMQ\Jobs;

use App\Data\Models\Account;
use Lucid\Units\Job;

class MakeAccountJob extends Job
{
    private string $message;

    /**
     * Create a new job instance.
     *
     * @param string $message
     */
    public function __construct(string $message)
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
