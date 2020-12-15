<?php

namespace App\Domains\Redis\Jobs;

use App\Data\Models\Insights;
use App\Data\Models\Metrics;
use Lucid\Units\Job;
use Illuminate\Support\Facades\Redis;

class StoreInsightsJob extends Job
{
    /**
     * @var Insights
     */
    private Insights $insights;

    /**
     * Create a new job instance.
     *
     * @param Insights $insights
     */
    public function __construct(Insights $insights)
    {
        $this->insights = $insights;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle()
    {
        $username = $this->insights->account->username;
        $account = $this->insights->account;

        // Insights
        $key = "insights:{$this->insights->platform}:{$username}:latest:account";
        Redis::set($key, json_encode([
            "following" => $account->following,
            "followers" => $account->followers,
            "media_count" => $account->mediaCount
        ]));

        $key = "insights:{$this->insights->platform}:{$username}:latest:content";
        Redis::set($key, json_encode($this->insights->medias->toArray()));

        // Metrics
        $metrics = Metrics::makeFromMedias($this->insights->medias);
        $key = "insights:{$this->insights->platform}:{$username}:content:metrics";
        Redis::set($key, json_encode([
            "avg_likes" => $metrics->avgLikes,
            "avg_comments" => $metrics->avgComments,
            "avg_video_views" => $metrics->avgVideoViews
        ]));
    }
}
