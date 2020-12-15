<?php

namespace App\Domains\Redis\Jobs;

use App\Data\Collections\MediaCollection;
use App\Data\Models\Account;
use App\Data\Models\Insights;
use App\Data\Models\Metrics;
use App\Data\Repositories\InsightsRepository;
use Lucid\Units\Job;
use Illuminate\Support\Facades\Redis;

class StoreInsightsJob extends Job
{
    /**
     * @var array
     */
    private $message;

    /**
     * Create a new job instance.
     *
     * @param Insights $insights
     */
    public function __construct(array $message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @param InsightsRepository $insightsRepository
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        $insightsRepository = app()->make(InsightsRepository::class);

        $account = Account::makeFromArray($this->message['insights']['account']);
        $medias = MediaCollection::makeFromArray($this->message['insights']['content']);
        $insights = Insights::makeFromQueueMessage((int)$this->message['fetched_at'], $account, $medias);

        $username = $account->username;
        $insightsRepository->storeAccount($account, $insights->platform);
        $insightsRepository->storeMedias($medias, $insights->platform, $username);

        $metrics = Metrics::makeFromMedias($medias);
        $insightsRepository->storeMediasMetrics($metrics, $insights->platform, $username);
    }
}
