<?php


namespace Fei\Service\Notification\Client\Tests\Entity\Android;

use Fei\Service\Notification\Client\Entity\Alert\Android\Exception\AndroidPushException;
use Fei\Service\Notification\Client\Entity\Alert\Android\Message;
use Fei\Service\Notification\Client\Entity\Alert\Android\PushNotification;
use Codeception\Test\Unit;

class MessageTest extends Unit
{
    public function testAccessors()
    {
        $this->testOneAccessors('recipients', []);
        $this->testOneAccessors('collapseKey', 'fake-key');
        $this->testOneAccessors('priority', 'high');
        $this->testOneAccessors('timeToLive', 1);
        $this->testOneAccessors('restrictedPackageName', 'fake-package');
        $this->testOneAccessors('pushNotification', new PushNotification());

        $message = new Message();
        $message->setDryRun(false);
        $this->assertEquals($message->isDryRun(), false);
        $this->assertAttributeEquals($message->isDryRun(), 'dryRun', $message);
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

    public function testAddRecipient()
    {
        $message = new Message();
        $message->addRecipient('toto')
            ->addRecipient('titi');

        $this->assertEquals(['toto', 'titi'], $message->getRecipients());
    }

    public function testExceptionBuildArray()
    {
        $message = new Message();
        $message->setRecipients([]);

        $this->setExpectedException(AndroidPushException::class);

        $message->buildArray();
    }

    public function testBuildArray()
    {
        $expected = $expected = [
            'to' => 'fake-recipient',
            'priority' => 'high',
            'notification' =>
                [
                    'title' => 'fake-title',
                    'body' => 'fake-body',
                ],
                'time_to_live' => 2419200
        ];
        $message = (new Message())
            ->addRecipient('fake-recipient')
            ->setPushNotification((new PushNotification())
                ->setTitle('fake-title')
                ->setBody('fake-body'));

        $this->assertEquals($expected, $message->buildArray());
    }

    public function testBuildArrayWithMultipleRecipients()
    {
        $expected = $expected = [
            'registration_ids' => [
                'fake-recipient',
                'fake-recipient-2'
            ],
            'priority' => 'high',
            'notification' =>
                [
                    'title' => 'fake-title',
                    'body' => 'fake-body',
                ],
                'time_to_live' => 2419200
        ];
        $message = (new Message())
            ->addRecipient('fake-recipient')
            ->addRecipient('fake-recipient-2')
            ->setPushNotification((new PushNotification())
                ->setTitle('fake-title')
                ->setBody('fake-body'));

        $this->assertEquals($expected, $message->buildArray());
    }
}
