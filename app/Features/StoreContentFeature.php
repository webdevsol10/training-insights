<?php

namespace App\Features;

use App\Data\Models\Metrics;
use App\Domains\Talent\Jobs\MakeAccountJob;
use App\Domains\Talent\Jobs\MakeInsightsJob;
use App\Domains\Talent\Jobs\MakeMediasJob;
use App\Domains\RabbitMQ\Jobs\ValidateQueueMessageJob;
use App\Domains\Redis\Jobs\StoreAccountInsightsJob;
use App\Domains\Redis\Jobs\StoreContentInsightsJob;
use App\Domains\Redis\Jobs\StoreMetricsInsightsJob;
use App\Domains\Talent\Jobs\MakeMetricsJob;
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
            'account' => $this->message['insights']['account']
        ]);

        $medias = $this->run(MakeMediasJob::class, [
            'medias' => $this->message['insights']['content']
        ]);

        $insights = $this->run(MakeInsightsJob::class, [
            'fetchedAt' => (int)$this->message['fetched_at'],
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
        $metrics = $this->run(MakeMetricsJob::class, [
            'medias' => $medias
        ]);

        $this->run(StoreMetricsInsightsJob::class, [
            'platform' => $insights->platform,
            'username' => $account->username,
            'metrics' => $metrics
        ]);
    }
}
