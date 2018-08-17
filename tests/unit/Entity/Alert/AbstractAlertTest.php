<?php
namespace Fei\Service\Notification\Client\Tests\Entity;

use DateInterval;
use Fei\Service\Notification\Client\Entity\Alert\AbstractAlert;
use Fei\Service\Notification\Client\Entity\Alert\Android;
use Fei\Service\Notification\Client\Entity\Alert\Android\Message;
use Fei\Service\Notification\Client\Entity\Notification;
use Codeception\Test\Unit;

class AbstractAlertTest extends Unit
{
    public function testNotificationTest()
    {
        $alert = new Class extends AbstractAlert{
            public function getType()
            {
                return 'tube';
            }
        };

        $notification = new Notification();
        $alert->setNotification($notification);

        $this->assertEquals($notification, $alert->getNotification());
        $this->assertAttributeEquals($alert->getNotification(), 'notification', $alert);
    }

    public function testTriggerTest()
    {
        $alert = new Class extends AbstractAlert {
            public function getType()
            {
                return 'tube';
            }
        };

        $interval = new DateInterval('P2Y4DT6H8M');
        $alert->setTrigger($interval);

        $this->assertEquals($interval, $alert->getTrigger());
        $this->assertAttributeEquals($alert->getTrigger(), 'trigger', $alert);
    }

    public function testToArray()
    {
        $expected = [
            'type' => 'android-push',
            'notification' => null,
            'trigger' => null,
            'message' => [
                'data' => [],
                'notification' => null,
                'token' => '',
                'topic' => '',
                'condition' => ''
            ]
        ];

        $notification = new Notification();

        $alert = (new Android())
            ->setNotification($notification)
            ->setMessage((new Message()));


        $this->assertEquals($expected, $alert->toArray());
    }
}
