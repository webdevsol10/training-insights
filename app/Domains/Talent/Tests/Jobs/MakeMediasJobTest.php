<?php

namespace App\Domains\Talent\Tests\Jobs;

use App\Data\Collections\MediaCollection;

use App\Domains\Talent\Jobs\MakeMediasJob;
use Tests\TestCase;

class MakeMediasJobTest extends TestCase
{
    public function test_make_medias_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));
        $job = new MakeMediasJob($rawMessage['insights']['content']);
        $medias = $job->handle();

        $this->assertEquals($medias, MediaCollection::makeFromArray($rawMessage['insights']['content']));
    }
}
