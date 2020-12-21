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

    /**
     * @param $platform
     * @param $handle
     * @return string
     */
    public function getMedias(string $platform, string $handle)
    {
        $key = "insights:{$platform}:{$handle}:latest:content";
        return Redis::get($key) ?? '';
    }

    /**
     * @param string $platform
     * @param string $handle
     * @return string
     */
    public function getMediasMetrics(string $platform, string $handle)
    {
        $key = "insights:{$platform}:{$handle}:content:metrics";
        return Redis::get($key) ?? '';
    }

    /**
     * @param string $platform
     * @param string $handle
     * @return string
     */
    public function getAccount(string $platform, string $handle)
    {
        $key = "insights:{$platform}:{$handle}:latest:account";
        return Redis::get($key) ?? '';
    }
}
