<?php

namespace App\Features;

use App\Domains\RabbitMQ\Jobs\ValidateQueueMessageJob;
use App\Domains\Redis\Jobs\StoreInsightsJob;
use Lucid\Units\Feature;
use Illuminate\Http\Request;

class StoreContentFeature extends Feature
{
    public function __construct(array $message)
    {

    }

    public function handle($message)
    {
        // validate data
        $isValidMessage = $this->run(ValidateQueueMessageJob::class, [
            'message' => $message
        ]);

        if ($isValidMessage) {
            $this->run(StoreInsightsJob::class, [
                'message' => $message
            ]);
        }
    }
}
