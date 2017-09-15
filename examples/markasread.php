<?php

use Fei\ApiClient\AbstractApiClient;
use Fei\ApiClient\Transport\BasicTransport;
use Fei\Service\Notification\Client\Builder\SearchBuilder;
use Fei\Service\Notification\Client\Notifier;

require dirname(__DIR__) . '/vendor/autoload.php';

$notifier = new Notifier([AbstractApiClient::OPTION_BASEURL => 'http://127.0.0.1:8800']);
$notifier->setTransport(new BasicTransport());

try {

    $builder = new SearchBuilder();
    $builder->origin()->equal('my-origin');

    $res = $notifier->markAsRead($builder);
    var_dump($res);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
