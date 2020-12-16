<?php

namespace App\Tests\Features;

use Tests\TestCase;
use App\Features\ServeContentMetricsFeature;

class ServeContentMetricsFeatureTest extends TestCase
{
    public function test_servecontentmettricsfeature()
    {
        $response = $this->get('/instagram/third_eye_thirst/content/metrics');

        $content = file_get_contents(base_path('/tests/resources/metrics.json'));
        $this->assertEquals($content,$response->getContent());
        $response->assertStatus(200);

        $response = $this->get('/instagram/third_eye_thirst22/content/metrics');
        $this->assertEquals('', $response->getContent());
        $response->assertStatus(200);
    }


}
