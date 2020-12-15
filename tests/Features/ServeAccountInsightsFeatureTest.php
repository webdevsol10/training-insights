<?php

namespace App\Tests\Features;

use Tests\TestCase;
use App\Features\ServeAccountInsightsFeature;

class ServeAccountInsightsFeatureTest extends TestCase
{
    public function test_serveaccountfeature()
    {
        $response = $this->get('/instagram/third_eye_thirst');
        $this->assertEquals('{"following":1348243,"followers":445,"media_count":2234}', $response->getContent());
        $response->assertStatus(200);

        $response = $this->get('/instagram/third_eye_thirst222');
        $this->assertEquals('', $response->getContent());
        $response->assertStatus(200);
    }
}
