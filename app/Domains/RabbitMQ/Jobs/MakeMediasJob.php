<?php

namespace App\Domains\RabbitMQ\Jobs;

use App\Data\Collections\MediaCollection;
use Lucid\Units\Job;

class MakeMediasJob extends Job
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
     * @return MediaCollection
     */
    public function handle()
    {
        return MediaCollection::makeFromArray($this->message['insights']['content']);
    }
}
