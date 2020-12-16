<?php

namespace App\Data\Repositories;

use App\Data\Collections\MediaCollection;
use App\Data\Models\Account;
use App\Data\Models\Metrics;
use Illuminate\Support\Facades\Redis;

class InsightsRepository
{

    /**
     * @param Account $account
     * @param string $platform
     * @return bool
     */
    public function storeAccount(Account $account, string $platform): bool
    {
        $key = "insights:{$platform}:{$account->username}:latest:account";
        return Redis::set($key, json_encode([
            "following" => $account->following,
            "followers" => $account->followers,
            "media_count" => $account->mediaCount
        ]));
    }

    /**
     * @param MediaCollection $medias
     * @param string $platform
     * @param string $username
     * @return mixed
     */
    public function storeMedias(MediaCollection $medias, string $platform, string $username)
    {
        $key = "insights:{$platform}:{$username}:latest:content";
        return Redis::set($key, json_encode($medias->toArray()));
    }

    /**
     * @param Metrics $metrics
     * @param string $platform
     * @param string $username
     * @return mixed
     */
    public function storeMediasMetrics(Metrics $metrics, string $platform, string $username)
    {
        $key = "insights:{$platform}:{$username}:content:metrics";
        return Redis::set($key, json_encode([
            "avg_likes" => $metrics->avgLikes,
            "avg_comments" => $metrics->avgComments,
            "avg_video_views" => $metrics->avgVideoViews
        ]));
    }
}
