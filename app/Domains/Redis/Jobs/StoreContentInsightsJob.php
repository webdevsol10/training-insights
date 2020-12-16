<?php

namespace App\Domains\Redis\Jobs;

use App\Data\Collections\MediaCollection;
use App\Data\Models\Account;
use App\Data\Repositories\InsightsRepository;
use Lucid\Units\Job;

class StoreContentInsightsJob extends Job
{
    /**
     * @var string
     */
    private $platform;
    /**
     * @var string
     */
    private $username;
    /**
     * @var MediaCollection
     */
    private $medias;


    /**
     * Create a new job instance.
     *
     * @param string $platform
     * @param string $username
     * @param MediaCollection $medias
     */
    public function __construct(string $platform, string $username, MediaCollection $medias)
    {
        $this->platform = $platform;
        $this->username = $username;
        $this->medias = $medias;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(InsightsRepository $insightsRepository)
    {
        return $insightsRepository->storeMedias($this->platform, $this->username, $this->medias);
    }
}
