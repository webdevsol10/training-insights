<?php


namespace App\Messaging\Handlers;

use App\Features\StoreContentFeature;
use Lucid\Bus\ServesFeatures;
use Lucid\Exceptions\InvalidInputException;
use MongoDB\Driver\Exception\ConnectionException;
use MongoDB\Driver\Exception\ConnectionTimeoutException;

class InstagramInsightsHandler
{
    use ServesFeatures;

    public function handle($msg)
    {
        $this->serve(StoreContentFeature::class, [
            'message' => $msg
        ]);
    }

    public function handleError($e, $broker)
    {
        if($e instanceof InvalidInputException) {
            $broker->rejectMessage();
        }

        if ($e instanceof ConnectionException || $e instanceof ConnectionTimeoutException) {
            sleep(5);

            // Requeue msg
            $broker->rejectMessage(true);
        }
    }
}
