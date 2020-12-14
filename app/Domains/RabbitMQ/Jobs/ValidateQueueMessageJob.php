<?php

namespace App\Domains\RabbitMQ\Jobs;

use Illuminate\Support\Facades\Validator;
use Lucid\Units\Job;
use phpDocumentor\Reflection\Types\Boolean;

class ValidateQueueMessageJob extends Job
{
    /**
     * @var array
     */
    private $message;

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
     * @return void
     */
    public function handle() : Boolean
    {
        return !Validator::make($this->message, [
            "username" => "required",
            "platform_id" => "required",
            "platform" => "required",
            "source" => "required",
            "fetched_at" => "required",
            "insights" => "required|array",
            "insights.account" => "required|array",
            "insights.content" => "required|array",
        ])->fails();
    }
}
