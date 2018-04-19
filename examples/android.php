<?php

use Fei\ApiClient\AbstractApiClient;
use Fei\ApiClient\Transport\BasicTransport;
use Fei\Service\Notification\Client\Entity\Alert\Android;
use Fei\Service\Notification\Client\Entity\Notification;
use Fei\Service\Notification\Client\Notifier;

require dirname(__DIR__) . '/vendor/autoload.php';

$notifier = new Notifier([AbstractApiClient::OPTION_BASEURL => 'http://127.0.0.1:8800']);
$notifier->setTransport(new BasicTransport());

try {
    $notification = (new Notification())
        ->setMessage('Last test')
        ->setOrigin('test')
        ->setEvent('Android event')
        ->setType(Notification::TYPE_INFO)
        ->setAction(json_encode(['my.action' => 'action']))
        ->setRecipient('boris');

    $results = $notifier->notify($notification);

    $message = (new Android\Message())
        ->setTopic('test1')
        ->setNotification(
            (new Android\Notification())
                ->setTitle('title')
                ->setBody('body')
        );

    $alert = (new Android())
        ->setMessage($message)
        ->setNotification(reset($results))
        ->setTrigger(0);

    $res = $notifier->alert($alert);

    print_r($res);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
