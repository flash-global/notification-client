<?php


namespace Fei\Service\Notification\Client\Tests\Entity\Android;

use Fei\Service\Notification\Client\Entity\Alert\Android\Message;
use Fei\Service\Notification\Client\Entity\Alert\Android\Notification;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testAccessors()
    {
        $notification = (new Notification())
            ->setBody('body')
            ->setTitle('title');

        $message = (new Message())
            ->setNotification($notification)
            ->setData(['data' => 'test'])
            ->setToken('token')
            ->setTopic('topic')
            ->setCondition('condition');

        $this->assertEquals('token', $message->getToken());
        $this->assertEquals('topic', $message->getTopic());
        $this->assertEquals('condition', $message->getCondition());
        $this->assertEquals(['data' => 'test'], $message->getData());
        $this->assertEquals($notification, $message->getNotification());
    }

    public function testToArray()
    {
        $expected = [
            'data' => [
                'data' => 'test'
            ],
            'notification' => [
                'title' => 'title',
                'body' => 'body'
            ],
            'token' => 'token',
            'topic' => 'topic',
            'condition' => 'condition'
        ];

        $notification = (new Notification())
            ->setBody('body')
            ->setTitle('title');

        $message = (new Message())
            ->setNotification($notification)
            ->setData(['data' => 'test'])
            ->setToken('token')
            ->setTopic('topic')
            ->setCondition('condition');


        $this->assertEquals($expected, $message->toArray());
    }
}
