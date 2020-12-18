<?php

namespace App\Data\Models;

class Account
{
    public string $id;
    public int $followers;
    public int $following;
    public int $mediaCount;
    public string $username;

    /**
     * Account constructor.
     * @param string $id
     * @param string $username
     * @param int $followers
     * @param int $following
     * @param int $mediaCount
     */
    public function __construct(string $id, string $username, int $followers, int $following, int $mediaCount)
    {
        $this->id = $id;
        $this->followers = $followers;
        $this->following = $following;
        $this->mediaCount = $mediaCount;
        $this->username = $username;
    }

    public static function makeFromArray(array $account)
    {
        return new self(
            $account['id'],
            $account['username'],
            (int)$account['followers'],
            (int)$account['following'],
            (int)$account['media_count']
        );
    }

    public function toInsightsArray()
    {
        return [
            'following' => $this->following,
            'followers' => $this->followers,
            'media_count' => $this->mediaCount,
        ];
    }

    public function toJson()
    {
        return $this->toArray();
    }

}
