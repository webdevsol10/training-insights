<?php


namespace App\Data\Models;

use App\Data\Collections\MediaCollection;
use App\Data\Enums\MediaType;

class Metrics
{
    /**
     * @var float
     */
    public float $avgLikes;
    /**
     * @var float
     */
    public float $avgComments;
    /**
     * @var float
     */
    public float $avgVideoViews;


    public function __construct(float $avgLikes, float $avgComments, float $avgVideoViews)
    {
        $this->avgLikes = $avgLikes;
        $this->avgComments = $avgComments;
        $this->avgVideoViews = $avgVideoViews;
    }

    /**
     * @param MediaCollection $medias
     * @return Metrics
     * @throws \Exception
     */
    public static function makeFromMedias(MediaCollection $medias): Metrics
    {
        $count = $medias->count();

        if ($count === 0) {
            throw new \Exception('Media collection is empty');
        }

        $videos = $medias->filter(fn($media) => MediaType::VIDEO() === $media->type);
        $videoViews = $videos->sum('video_views');
        $likes = $medias->sum('likes');
        $comments = $medias->sum('comments');

        return new self($likes / $count,$comments / $count,$videoViews / $count);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            "avg_likes" => $this->avgLikes,
            "avg_comments" => $this->avgComments,
            "avg_video_views" => $this->avgVideoViews
        ];
    }
}
