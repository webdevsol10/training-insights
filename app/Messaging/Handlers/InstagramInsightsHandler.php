<?php


namespace App\Messaging\Handlers;


use App\Features\StoreContentFeature;
use Lucid\Exceptions\InvalidInputException;

class InstagramInsightsHandler
{
    public function handle($msg)
    {
        $storeFeature = new StoreContentFeature($msg);
        $storeFeature->handle();
    }

    public function handleError($e, $broker)
    {
        if($e instanceof InvalidInputException) {
            $broker->rejectMessage();
        } else {
            $msg = $broker->getMessage();
            if($msg->body) {
                //
            }
        }
    }
}
