<?php

namespace App\Domains\RabbitMQ\Tests\Jobs;

use App\Domains\RabbitMQ\Jobs\ValidateQueueMessageJob;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ValidateQueueMessageJobTest extends TestCase
{
    public function test_validate_success_queue_message_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));

        $job = new ValidateQueueMessageJob($rawMessage);
        $valid = $job->handle();

        $this->assertTrue($valid);
    }

    public function test_validate_fails_queue_message_job()
    {
        $rawMessage = unserialize(file_get_contents(base_path('tests/resources/insights.txt')));

        foreach (array_keys($rawMessage) as $key) {
            $tempMessage = $rawMessage;
            unset($tempMessage[$key]);

            try{
                $job = new ValidateQueueMessageJob($tempMessage);
                $job->handle();

                $this->fail("Expected exception for key `$key` not thrown");
            } catch (ValidationException $e){

            }
        }

        $this->assertTrue(true);
    }
}
