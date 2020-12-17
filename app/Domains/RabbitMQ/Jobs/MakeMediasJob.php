<?php

namespace App\Domains\RabbitMQ\Jobs;

use App\Data\Collections\MediaCollection;
use Lucid\Units\Job;

class MakeMediasJob extends Job
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
     * @return MediaCollection
     */
    public function handle()
    {
        return MediaCollection::makeFromArray($this->message['insights']['content']);
    }
}
