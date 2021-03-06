<?php

namespace App\Data\Models;

use DateTime;
use App\Data\Enums\MediaType;
use Illuminate\Contracts\Support\Arrayable;
use App\Exceptions\InvalidMediaTypeException;
use InstagramScraper\Model\Media as ScraperMedia;

class Media implements Arrayable
{
    public string $id;
    public string $code;
    public MediaType $type;
    public string $link;
    public string $thumbnailUrl;
    public bool $isAd;
    public DateTime $createdAt;
    public ?string $caption;
    public ?int $likes;
    public ?int $comments;
    public ?int $video_views;

    public function __construct(
        string $id,
        string $code,
        MediaType $type,
        string $link,
        string $thumbnailUrl,
        bool $isAd,
        DateTime $createdAt,
        ?string $caption = '',
        ?int $likes = 0,
        ?int $comments = 0,
        ?int $video_views = 0
    ) {

        $this->id = $id;
        $this->code = $code;
        $this->type = $type;
        $this->link = $link;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->isAd = $isAd;
        $this->createdAt = $createdAt;
        $this->caption = $caption;
        $this->likes = $likes;
        $this->comments = $comments;
        $this->video_views = $video_views;
    }

    public static function makeFromArray(array $media)
    {
        return new self(
            $media['id'],
            $media['code'],
            self::buildTypeFromString($media['type']),
            $media['link'],
            $media['thumbnail_url'],
            $media['is_ad'],
            (new DateTime)->setTimestamp($media['created_at']),
            $media['caption'],
            $media['likes'],
            $media['comments'],
            $media['video_views']
        );
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'type' => $this->type->getValue(),
            'link' => $this->link,
            'thumbnail_url' => $this->thumbnailUrl,
            'is_ad' => $this->isAd,
            'created_at' => $this->createdAt->getTimestamp(),
            'caption' => $this->caption,
            'likes' => $this->likes,
            'comments' => $this->comments,
            'video_views' => $this->video_views,
        ];
    }

    public function toJson()
    {
        return $this->toArray();
    }

    protected static function buildTypeFromString(string $typeString): MediaType
    {
        switch ($typeString) {
            case 'photo':
                $type = MediaType::PHOTO();
                break;
            case 'carousel':
                $type = MediaType::CAROUSEL();
                break;
            case 'video':
                $type = MediaType::VIDEO();
                break;
            default:
                throw new InvalidMediaTypeException($typeString);
        }

        return $type;
    }
}
