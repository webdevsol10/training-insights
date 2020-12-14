<?php

namespace App\Data\Collections;

use App\Data\Models\Media;
use Illuminate\Support\Collection;

class MediaCollection extends Collection
{
    public static function makeFromArray(array $data)
    {
        return new self(array_map(fn($media) => Media::makeFromArray($media), $data));
    }
}
