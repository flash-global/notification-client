<?php

use Fei\ApiClient\AbstractApiClient;
use Fei\ApiClient\Transport\BasicTransport;
use Fei\Service\Notification\Client\Entity\Alert\Email;
use Fei\Service\Notification\Client\Entity\Notification;
use Fei\Service\Notification\Client\Notifier;

require dirname(__DIR__) . '/vendor/autoload.php';

$notifier = new Notifier([AbstractApiClient::OPTION_BASEURL => 'http://127.0.0.1:8800',
                            AbstractApiClient::OPTION_HEADER_AUTHORIZATION => 'key']);

$notifier->setTransport(new BasicTransport());

try {
    $notification = (new Notification())
        ->setMessage('Last test')
        ->setOrigin('test')
        ->setEvent('My best event')
        ->setType(Notification::TYPE_INFO)
        ->setAction(json_encode(['my.action' => 'first create']))
        ->setRecipient('user');

    $results = $notifier->notify($notification);

    $alert = (new Email())
        ->setNotification(reset($results))
        ->setSubject('Email Subject')
        ->setContent('Email content')
        ->setTrigger(1)
        ->setEmail('email@provider.com');

    $res = $notifier->alert($alert);

    print_r($res);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
