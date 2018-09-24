<?php

use Fei\ApiClient\AbstractApiClient;
use Fei\ApiClient\Transport\BasicTransport;
use Fei\Service\Notification\Client\Notifier;

require dirname(__DIR__) . '/vendor/autoload.php';

$notifier = new Notifier([AbstractApiClient::OPTION_BASEURL => 'http://127.0.0.1:8800',
                            AbstractApiClient::OPTION_HEADER_AUTHORIZATION => 'key']);

$notifier->setTransport(new BasicTransport());

try {
    $res = $notifier->fetchOne(1);

    echo '<pre>';
    print_r($res);
    echo '</pre>';
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
