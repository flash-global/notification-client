<?php


namespace Fei\Service\Notification\Client\Tests\Entity;

use Fei\Service\Notification\Client\Entity\Alert\Android;
use Fei\Service\Notification\Client\Entity\Alert\Android\Message;
use Codeception\Test\Unit;

class AndroidTest extends Unit
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

    public function testHydrate()
    {
        $data = [
            'message' => [
                'notification' => [
                    'title' => 'fake-title',
                    'body' => 'fake-body'
                ]
            ]
        ];

        $android = new Android();

        $expected = (new Android())
            ->setMessage((new Message())
                ->setNotification((new Android\Notification())
                    ->setTitle('fake-title')
                    ->setBody('fake-body')));

        $this->assertEquals($expected, $android->hydrate($data));
    }
}
