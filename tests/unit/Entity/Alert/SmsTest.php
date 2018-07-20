<?php


namespace Fei\Service\Notification\Tests\Entity;

use Fei\Service\Notification\Client\Entity\Alert\Sms;
use Fei\Service\Notification\Client\Entity\Alert\Sms\Message;
use Codeception\Test\Unit;

class SmsTest extends Unit
{
    public function testAccessors()
    {
        $message = new Message();

        $this->testOneAccessors('messages', $message, [$message]);
    }

    public function testGetTypeName()
    {
        $this->assertEquals('sms', (new Sms())->getType());
    }

    protected function testOneAccessors($name, $set, $expected = null)
    {
        $expected = isset($expected) ? $expected : $set;

        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);

        $notification = new Sms();
        $notification->$setter($set);

        $this->assertEquals($notification->$getter(), $expected);
        $this->assertAttributeEquals($notification->$getter(), $name, $notification);
    }
}
