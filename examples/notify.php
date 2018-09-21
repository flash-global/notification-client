<?php

use Fei\ApiClient\AbstractApiClient;
use Fei\ApiClient\Transport\BasicTransport;
use Fei\Service\Notification\Client\Entity\Notification;
use Fei\Service\Notification\Client\Notifier;

require dirname(__DIR__) . '/vendor/autoload.php';

$notifier = new Notifier([AbstractApiClient::OPTION_BASEURL => 'http://127.0.0.1:8800',
                            AbstractApiClient::OPTION_HEADER_AUTHORIZATION => 'key']);

$notifier->setTransport(new BasicTransport());

try {
    $notif1 = (new Notification())
        ->setMessage('Last test')
        ->setOrigin('test')
        ->setEvent('My best event')
        ->setType(1)
        ->setAction(json_encode(['my.action' => 'first create']))
        ->setRecipient('bobo');

    $notif2 = (new Notification())
        ->setMessage('last test')
        ->setOrigin('super.test')
        ->setEvent('My favourite event')
        ->setType(1)
        ->setAction(json_encode(['my.second.action' => 'second create']))
        ->setRecipient('toto');

    $notifications = [$notif1, $notif2];
    $res = $notifier->notify($notifications);
    var_dump($res);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
