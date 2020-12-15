<?php

namespace App\Tests\Features;

use Illuminate\Support\Facades\Redis;
use Tests\TestCase;
use App\Features\StoreContentFeature;

class StoreContentFeatureTest extends TestCase
{
    public function test_storecontentfeature_should_pass()
    {
        $platform = 'instagram';
        $username = 'third_eye_thirst';

        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));
        $f = new StoreContentFeature($rawMessage);
        $f->handle();

        $key = "insights:{$platform}:{$username}:latest:account";
        $this->assertEquals("{\"following\":1348243,\"followers\":445,\"media_count\":2234}", Redis::get($key));

        $key = "insights:{$platform}:{$username}:latest:content";
        $this->assertIsArray(json_decode(Redis::get($key)));

        $key = "insights:{$platform}:{$username}:content:metrics";
        $this->assertEquals("{\"avg_likes\":16104.65,\"avg_comments\":137.95,\"avg_video_views\":0}", Redis::get($key));
    }
}
