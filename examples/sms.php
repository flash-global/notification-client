<?php

use Fei\ApiClient\AbstractApiClient;
use Fei\ApiClient\Transport\BasicTransport;
use Fei\Service\Notification\Client\Notifier;
use Fei\Service\Notification\Entity\Alert\Sms;
use Fei\Service\Notification\Entity\Notification;

require dirname(__DIR__) . '/vendor/autoload.php';

$notifier = new Notifier([AbstractApiClient::OPTION_BASEURL => 'http://127.0.0.1:8081',
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

    $alert = (new Sms())
        ->setMessages(
            (new Sms\Message())
                ->setRecipients(['+33661103229'])
                ->setFrom('Test')
                ->setContent('This is a test')
        )
        ->setNotification(new Notification($results[0]));

    $res = $notifier->alert($alert);

    print_r($res);
} catch (\Exception $e) {
    var_dump($e);
}
