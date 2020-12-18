<?php

namespace App\Domains\RabbitMQ\Jobs;

use App\Data\Collections\MediaCollection;
use Lucid\Units\Job;

class MakeMediasJob extends Job
{
    private array $medias;

    /**
     * Create a new job instance.
     *
     * @param array $medias
     */
    public function __construct(array $medias)
    {
        $this->medias = $medias;
    }

    /**
     * Execute the job.
     *
     * @return MediaCollection
     */
    public function handle()
    {
        return MediaCollection::makeFromArray($this->medias);
    }
}
