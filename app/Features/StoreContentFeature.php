<?php

namespace App\Features;

use App\Data\Models\Metrics;
use App\Domains\RabbitMQ\Jobs\MakeAccountJob;
use App\Domains\RabbitMQ\Jobs\MakeInsightsJob;
use App\Domains\RabbitMQ\Jobs\MakeMediasJob;
use App\Domains\RabbitMQ\Jobs\ValidateQueueMessageJob;
use App\Domains\Redis\Jobs\StoreAccountInsightsJob;
use App\Domains\Redis\Jobs\StoreContentInsightsJob;
use App\Domains\Redis\Jobs\StoreMetricsInsightsJob;
use Lucid\Units\Feature;


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
        // Validate data
        $this->run(ValidateQueueMessageJob::class, [
            'message' => $this->message
        ]);

        $account = $this->run(MakeAccountJob::class, [
            'message' => $this->message
        ]);

        $medias = $this->run(MakeMediasJob::class, [
            'message' => $this->message
        ]);

        $insights = $this->run(MakeInsightsJob::class, [
            'message' => $this->message,
            'account' => $account,
            'medias' => $medias,
        ]);

        // Account
        $this->run(StoreAccountInsightsJob::class, [
            'platform' => $insights->platform,
            'account' => $account
        ]);

        // Content
        $this->run(StoreContentInsightsJob::class, [
            'platform' => $insights->platform,
            'username' => $account->username,
            'medias' => $medias
        ]);

        // Metrics
        $metrics = Metrics::makeFromMedias($medias);
        $this->run(StoreMetricsInsightsJob::class, [
            'platform' => $insights->platform,
            'username' => $account->username,
            'metrics' => $metrics
        ]);
    }
}
