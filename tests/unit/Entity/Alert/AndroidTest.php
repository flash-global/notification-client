<?php


namespace Fei\Service\Notification\Client\Tests\Entity;

use Fei\Service\Notification\Client\Entity\Alert\Android;
use Fei\Service\Notification\Client\Entity\Alert\Android\Message;
use PHPUnit\Framework\TestCase;

class AndroidTest extends TestCase
{
    public function testMessage()
    {
        $android = new Android();
        $message = new Message();
        $android->setMessage($message);

        $this->assertEquals($android->getMessage(), $message);
        $this->assertAttributeEquals($android->getMessage(), 'message', $android);
    }

    public function testGetTypeName()
    {
        $this->assertEquals('android-push', (new Android())->getType());
    }

    public function testGetAndroidNotification()
    {
        $android = new Android();

        $expected = [
            'to' => 'toto',
            'priority' => 'high',
            'notification' =>
                [
                    'title' => 'my push',
                    'body' => 'my big body',
                ],
        ];

        $messageMock = $this->getMockBuilder(Message::class)->setMethods(['toArray'])->getMock();
        $messageMock->expects($this->once())->method('toArray')->willReturn($expected);
        $android->setMessage($messageMock);

        $this->assertEquals($expected, $android->getAndroidNotification());
    }

    public function testHydrate()
    {
        $data = [
            'message' => [
                'pushNotification' => [
                    'title' => 'fake-title',
                    'body' => 'fake-body'
                ]
            ]
        ];

        $android = new Android();

        $expected = (new Android())
            ->setMessage((new Message())
                ->setPushNotification((new Android\PushNotification())
                    ->setTitle('fake-title')
                    ->setBody('fake-body')));

        $this->assertEquals($expected, $android->hydrate($data));
    }
}
