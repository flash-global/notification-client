<?php


namespace Fei\Service\Notification\Client\Tests\Entity\Android;

use Fei\Service\Notification\Client\Entity\Alert\Android\PushNotification;
use PHPUnit\Framework\TestCase;

class PushNotificationTest extends TestCase
{
    public function testAccessors()
    {
        $this->testOneAccessors('title', 'fake-title');
        $this->testOneAccessors('body', 'fake-body');
        $this->testOneAccessors('androidChannelId', 'fake-channel');
        $this->testOneAccessors('icon', 'fake-icon');
        $this->testOneAccessors('sound', 'fake-sound');
        $this->testOneAccessors('tag', 'fake-tag');
        $this->testOneAccessors('color', 'fake-color');
        $this->testOneAccessors('clickAction', 'fake-click-action');
        $this->testOneAccessors('bodyLocKey', 'fake-loc-keys');
        $this->testOneAccessors('bodyLocArgs', []);
        $this->testOneAccessors('titleLocKey', 'fake-title-loc-key');
        $this->testOneAccessors('titleLocArgs', []);
    }

    public function testBuildArray()
    {
        $notification = (new PushNotification())
            ->setTitle('fake-title')
            ->setBody('fake-body')
            ->setAndroidChannelId('fake-channel')
            ->setIcon('fake-icon')
            ->setSound('fake-sound')
            ->setTag('fake-tag')
            ->setColor('fake-color')
            ->setClickAction('fake-click-action')
            ->setBodyLocKey('fake-body-loc-key')
            ->setBodyLocArgs([])
            ->setTitleLocKey('fake-title-loc-key')
            ->setTitleLocArgs([]);

        $expected = [
            'title' => 'fake-title',
            'body' => 'fake-body',
            'android_channel_id' => 'fake-channel',
            'icon' => 'fake-icon',
            'sound' => 'fake-sound',
            'tag' => 'fake-tag',
            'color' => 'fake-color',
            'click_action' => 'fake-click-action',
            'body_loc_key' => 'fake-body-loc-key',
            'title_loc_key' => 'fake-title-loc-key',
        ];
        $this->assertEquals($expected, $notification->buildArray());
    }

    protected function testOneAccessors($name, $expected)
    {
        $setter = 'set' . ucfirst($name);
        $getter = 'get' . ucfirst($name);

        $notification = new PushNotification();
        $notification->$setter($expected);

        $this->assertEquals($notification->$getter(), $expected);
        $this->assertAttributeEquals($notification->$getter(), $name, $notification);
    }
}
