<?php


namespace Fei\Service\Notification\Client\Tests\Entity\Android;

use Fei\Service\Notification\Client\Entity\Alert\Android\Notification;
use PHPUnit\Framework\TestCase;

class NotificationTest extends TestCase
{
    public function testAccessors()
    {
        $notification = (new Notification())
            ->setTitle('title')
            ->setBody('body');

        $this->assertEquals('body', $notification->getBody());
        $this->assertEquals('title', $notification->getTitle());
    }
}
