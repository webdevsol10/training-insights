<?php

namespace App\Domains\RabbitMQ\Tests\Jobs;

use App\Domains\RabbitMQ\Jobs\ValidateQueueMessageJob;
use Tests\TestCase;

class ValidateQueueMessageJobTest extends TestCase
{
    public function test_validate_queue_message_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));

        $job = new ValidateQueueMessageJob($rawMessage);
        $valid = $job->handle();

        $this->assertTrue($valid);
    }
}
