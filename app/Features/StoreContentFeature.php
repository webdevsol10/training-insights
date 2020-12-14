<?php

namespace App\Features;

use App\Domains\RabbitMQ\Jobs\ValidateQueueMessageJob;
use App\Domains\Redis\Jobs\StoreInsightsJob;
use Lucid\Units\Feature;
use Illuminate\Http\Request;

class StoreContentFeature extends Feature
{
    /**
     * @var array
     */
    private $message;

    /**
     * StoreContentFeature constructor.
     * @param array $message
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    public function handle()
    {
        // validate data
        $insightsModel = $this->run(ValidateQueueMessageJob::class, [
            'message' => $this->message
        ]);

        if ($insightsModel) {
            $this->run(StoreInsightsJob::class, [
                'insights' => $insightsModel
            ]);
        }
    }
}
