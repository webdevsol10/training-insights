<?php

namespace App\Tests\Features;

use Tests\TestCase;
use App\Features\ServeContentInsightsFeature;

class ServeContentInsightsFeatureTest extends TestCase
{
    public function test_servecontentinsightsfeature()
    {
        $response = $this->get('/instagram/third_eye_thirst/content/insights');

        $content = file_get_contents(base_path('/tests/resources/content.json'));
        $this->assertEquals($content,$response->getContent());
        $response->assertStatus(200);
    }
}
