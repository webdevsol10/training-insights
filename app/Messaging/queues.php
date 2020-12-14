<?php

use Vinelab\Bowler\Facades\Registrator;

Registrator::queue('instagram_insights', 'App\Messaging\Handlers\InstagramInsightsHandler', [
    'exchangeName' => 'instagram_insights',
    'exchangeType'=> 'direct',
    'bindingKeys' => [
        'cleansed.instagram.insights',
    ],
    'pasive' => false,
    'durable' => true,
    'autoDelete' => false,
    'deadLetterQueueName' => 'dlx_queue',
    'deadLetterExchangeName' => 'dlx',
    'deadLetterExchangeType' => 'direct',
    'deadLetterRoutingKey' => 'warning',
    'messageTTL' => null
]);
