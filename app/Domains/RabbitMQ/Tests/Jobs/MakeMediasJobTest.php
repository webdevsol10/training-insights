<?php

namespace App\Domains\RabbitMQ\Tests\Jobs;

use App\Data\Collections\MediaCollection;
use App\Domains\RabbitMQ\Jobs\MakeMediasJob;
use Tests\TestCase;

class MakeMediasJobTest extends TestCase
{
    public function test_make_medias_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));
        $job = new MakeMediasJob($rawMessage);
        $medias = $job->handle();

        $this->assertEquals($medias, MediaCollection::makeFromArray($rawMessage['insights']['content']));
    }
}
