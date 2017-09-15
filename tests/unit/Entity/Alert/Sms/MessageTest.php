<?php


namespace Fei\Service\Notification\Client\Tests\Entity\Sms;

use Fei\Service\Notification\Client\Entity\Alert\Sms\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testAccessors()
    {
        $this->testOneAccessors('from', 'fake-from');
        $this->testOneAccessors('recipients', []);
        $this->testOneAccessors('content', 'fake-content');
    }

    public function testAddRecipient()
    {
        $message = new Message();

        $message->addRecipient('00345678967');
        $expected[] = '00345678967';

        $this->assertEquals($expected, $message->getRecipients());
    }

    protected function testOneAccessors($name, $expected)
    {
        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);

        $notification = new Message();
        $notification->$setter($expected);

        $this->assertEquals($notification->$getter(), $expected);
        $this->assertAttributeEquals($notification->$getter(), $name, $notification);
    }
}
