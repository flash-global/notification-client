<?php
namespace Fei\Service\Notification\Tests\Client\Entity;

use Fei\Service\Notification\Client\Entity\Notification;
use Codeception\Test\Unit;

class NotificationTest extends Unit
{
    public function testAccessors()
    {
        $this->testOneAccessors('id', 1);
        $this->testOneAccessors('origin', 'fake-origin');
        $this->testOneAccessors('recipient', 'fake-user');
        $this->testOneAccessors('event', 'fake-event');
        $this->testOneAccessors('message', 'fake-message');
        $this->testOneAccessors('type', Notification::TYPE_INFO);
        $this->testOneAccessors('createdAt', new \DateTime('2017-04-15'));
        $this->testOneAccessors('status', Notification::STATUS_ACKNOWLEDGED);
        $this->testOneAccessors('parentNotificationId', 7);

        $this->testOneAccessors('context', [
            'key1' => 'value1',
            'key2' => 'value2'
        ]);

        $this->testOneAccessors('action', json_encode([
            'url' => 'http://fake-url.fr',
            'label' => 'fake-label'
        ]));
    }

    public function testSetContextWithKeyAndValue()
    {
        $notification = new Notification();
        $notification->setContext('key', 'value');

        $this->assertEquals($notification->getContext('key'), 'value');
        $this->assertAttributeEquals($notification->getContext(), 'context', $notification);
    }

    public function testSetCreatedAtWhenParameterIsString()
    {
        $notification = new Notification();

        $fakeDate = '2017-09-11';
        $notification->setCreatedAt($fakeDate);

        $this->assertInstanceOf(\DateTime::class, $notification->getCreatedAt());
    }

    protected function testOneAccessors($name, $expected)
    {
        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);

        $notification = new Notification();
        $notification->$setter($expected);

        $this->assertEquals($notification->$getter(), $expected);
        $this->assertAttributeEquals($notification->$getter(), $name, $notification);
    }

    /**
     *
     */
    public function testGetEntityCollection()
    {
        $notification = new Notification();

        $this->assertEquals('notifications', $notification->getEntityCollection());
    }

    public function testActionWhenAnArrayIsGiven()
    {
        $expected = ['key' => 'value'];
        $notification = new Notification();
        $notification->setAction($expected);

        $this->assertAttributeEquals(json_encode($expected), 'action', $notification);
    }
}
