<?php

namespace App\Domains\RabbitMQ\Jobs;

use Illuminate\Support\Facades\Validator;
use Lucid\Units\Job;

class ValidateQueueMessageJob extends Job
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
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    public function handle(): bool
    {
        Validator::make($this->message, [
            "username" => "required",
            "platform_id" => "required",
            "platform" => "required",
            "source" => "required",
            "fetched_at" => "required",
            "insights" => "required|array",
            "insights.account" => "required|array",
            "insights.content" => "required|array",
        ])->validate();

        return true;
    }
}
