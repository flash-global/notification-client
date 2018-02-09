<?php
namespace Fei\Service\Notification\Client\Tests\Entity;

use DateInterval;
use Fei\Service\Notification\Client\Entity\Alert\AbstractAlert;
use Fei\Service\Notification\Client\Entity\Notification;
use PHPUnit\Framework\TestCase;

class AbstractAlertTest extends TestCase
{
    public function testNotificationTest()
    {
        $alert = $this->getMockForAbstractClass(AbstractAlert::class);

        $notification = new Notification();
        $alert->setNotification($notification);

        $this->assertEquals($notification, $alert->getNotification());
        $this->assertAttributeEquals($alert->getNotification(), 'notification', $alert);
    }

    public function testTriggerTest()
    {
        $alert = $this->getMockForAbstractClass(AbstractAlert::class);

        $interval = new DateInterval('P2Y4DT6H8M');
        $alert->setTrigger($interval);

        $this->assertEquals($interval, $alert->getTrigger());
        $this->assertAttributeEquals($alert->getTrigger(), 'trigger', $alert);
    }

    public function testToArray()
    {

        $notification = (new Notification())
            ->setMessage('fake-msg')
            ->setCreatedAt('2017-09-11T00:00:00+00:00');

        $alert = $this->getMockForAbstractClass(AbstractAlert::class);

        $alert->setNotification($notification);

        $expected = [
            'type' => null,
            'notification' => [
                'id' => null,
                'origin' => null,
                'recipient' => null,
                'event' => null,
                'type' => null,
                'created_at' => '2017-09-11T00:00:00+00:00',
                'status' => 0,
                'parent_notification_id' => null,
                'message' => 'fake-msg',
                'context' => [],
                'entity_collection' => 'notifications',
                'action' => null,
            ],
            'trigger' => 0
        ];

        $this->assertEquals($expected, $alert->toArray());
    }
}
