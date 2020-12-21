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
    public function storeAccount(string $platform, Account $account): bool
    {
        $key = "insights:{$platform}:{$account->username}:latest:account";
        return Redis::set($key, json_encode($account->toArray()));
    }

    /**
     * @param MediaCollection $medias
     * @param string $platform
     * @param string $username
     * @return mixed
     */
    public function storeMedias(string $platform, string $username, MediaCollection $medias)
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
    public function storeMediasMetrics(string $platform, string $username, Metrics $metrics)
    {
        $key = "insights:{$platform}:{$username}:content:metrics";
        return Redis::set($key, json_encode($metrics->toArray()));
    }
}
