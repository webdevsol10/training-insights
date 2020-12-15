<?php

namespace App\Domains\RabbitMQ\Jobs;

use App\Data\Collections\MediaCollection;
use App\Data\Models\Account;
use App\Data\Models\Insights;
use Illuminate\Support\Facades\Validator;
use Lucid\Units\Job;

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
    public function handle(): ?Insights
    {
        $validator = Validator::make($this->message, [
            "username" => "required",
            "platform_id" => "required",
            "platform" => "required",
            "source" => "required",
            "fetched_at" => "required",
            "insights" => "required|array",
            "insights.account" => "required|array",
            "insights.content" => "required|array",
        ]);
            //->validate();

//        return true;
        if ($validator->fails()) {
            return null;
        } else {
            $account = Account::makeFromArray($this->message['insights']['account']);
            $medias = MediaCollection::makeFromArray($this->message['insights']['content']);
            $insights = Insights::makeFromQueueMessage((int)$this->message['fetched_at'], $account, $medias);
            return $insights;
        }
    }
}
