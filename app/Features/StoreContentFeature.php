<?php

namespace App\Features;

use App\Data\Collections\MediaCollection;
use App\Data\Models\Account;
use App\Data\Models\Insights;
use App\Data\Models\Metrics;
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

        $account = Account::makeFromArray($this->message['insights']['account']);
        $medias = MediaCollection::makeFromArray($this->message['insights']['content']);
        $insights = Insights::makeFromQueueMessage((int)$this->message['fetched_at'], $account, $medias);

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
