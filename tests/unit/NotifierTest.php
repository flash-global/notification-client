<?php
namespace Tests\Fei\Service\Notification\Client;

use Codeception\Test\Unit;
use Codeception\Util\Stub;
use DateTime;
use Fei\ApiClient\RequestDescriptor;
use Fei\ApiClient\ResponseDescriptor;
use Fei\ApiClient\Transport\BasicTransport;
use Fei\ApiClient\Transport\SyncTransportInterface;
use Fei\Service\Notification\Client\Builder\SearchBuilder;
use Fei\Service\Notification\Entity\Alert\Email;
use Fei\Service\Notification\Entity\Notification;
use Fei\Service\Notification\Client\Exception\NotificationException;
use Fei\Service\Notification\Client\Notifier;
use Guzzle\Http\Exception\BadResponseException;
use GuzzleHttp\Psr7\Response;

/**
 * Class NotifierTest
 *
 * @package Tests\Fei\Service\Notification\Client
 */
class NotifierTest extends Unit
{
    public function testFetchAll()
    {
        $transport = $this->getMockBuilder(SyncTransportInterface::class)->getMock();

        $responseMock = $this->getMockBuilder(ResponseDescriptor::class)->setMethods(['getData'])->getMock();
        $responseMock->expects($this->once())->method('getData')->willReturn(array (
            0 =>
                array (
                    'id' => 113,
                    'origin' => 'super.test',
                    'recipient' => 'toto',
                    'event' => 'My favourite event',
                    'message' => 'This is a new message 2',
                    'type' => 1,
                    'createdAt' => '2017-09-04 12:41:01.000000',
                    'status' => 7,
                    'parent_notification_id' => null,
                    'contexts' => '[]',
                    'action' => '{"my.second.action": "second create"}',
                ),
            1 =>
                array (
                    'id' => 115,
                    'origin' => 'super.test',
                    'recipient' => 'toto',
                    'event' => 'My favourite event',
                    'message' => 'This is a new message 2',
                    'type' => 1,
                    'createdAt' => '2017-09-04 12:41:01.000000',
                    'status' => 7,
                    'parent_notification_id' => null,
                    'contexts' => '[]',
                    'action' => '{"my.second.action": "second create"}',
                ),
            2 =>
                array (
                    'id' => 117,
                    'origin' => 'super.test',
                    'recipient' => 'toto',
                    'event' => 'My favourite event',
                    'message' => 'This is a new message 2',
                    'type' => 1,
                    'createdAt' => '2017-09-04 12:41:01.000000',
                    'status' => 7,
                    'parent_notification_id' => null,
                    'contexts' => '[]',
                    'action' => '{"my.second.action": "second create"}',
                )
        ));

        $transport->expects($this->once())->method('send')->willReturn($responseMock);

        $client = new Notifier();
        $client->setTransport($transport);

        $response = $client->fetchAll(new SearchBuilder());

        $this->assertEquals($this->getCollection(), $response);
    }

    public function testFetchOne()
    {
        $transport = $this->getMockBuilder(SyncTransportInterface::class)->getMock();

        $responseMock = $this->getMockBuilder(ResponseDescriptor::class)->setMethods(['getData'])->getMock();
        $responseMock->expects($this->once())->method('getData')->willReturn(array (
            0 =>
                array (
                    'id' => 113,
                    'origin' => 'super.test',
                    'recipient' => 'toto',
                    'event' => 'My favourite event',
                    'message' => 'This is a new message 2',
                    'type' => 1,
                    'createdAt' => '2017-09-04 12:41:01.000000',
                    'status' => 7,
                    'parent_notification_id' => null,
                    'contexts' => '[]',
                    'action' => '{"my.second.action": "second create"}',
                ),
        ));

        $transport->expects($this->once())->method('send')->willReturn($responseMock);

        $client = new Notifier();
        $client->setTransport($transport);

        $response = $client->fetchOne(113);

        $this->assertInstanceOf(Notification::class, $response);
    }

    public function testNotify()
    {

        $notifications = [
            $notif1 = (new Notification())
                ->setMessage('Last test')
                ->setOrigin('test')
                ->setEvent('My best event')
                ->setType(1)
                ->setAction(json_encode(['my.action' => 'first create']))
                ->setRecipient('bobo'),
            $notif2 = (new Notification())
                ->setMessage('last test')
                ->setOrigin('super.test')
                ->setEvent('My favourite event')
                ->setType(1)
                ->setAction(json_encode(['my.second.action' => 'second create']))
                ->setRecipient('toto'),
            $notif3 = 'err'
        ];

        $transport = $this->getMockBuilder(SyncTransportInterface::class)->getMock();
        $responseMock = $this->getMockBuilder(ResponseDescriptor::class)->setMethods(['getBody'])->getMock();
        $responseMock->expects($this->once())->method('getBody')->willReturn(
            '{"created": [{"id":138,"origin":"test","recipient":"bobo","event":"My best event",
            "message":"Last test","type":1,"createdAt":"2017-09-05T09:05:38+00:00",
            "status":1,"parent_notification_id":null,"contexts":"[]",
            "action":"{\\u0022my.action\\u0022: \\u0022first create\\u0022}"},{"id":139,
            "origin":"super.test","recipient":"toto","event":"My favourite event",
            "message":"last test","type":1,"createdAt":"2017-09-05T09:05:38+00:00",
            "status":1,"parent_notification_id":null,"contexts":"[]",
            "action":"{\\u0022my.second.action\\u0022: \\u0022second create\\u0022}"}]}'
        );

        $transport->expects($this->once())->method('send')->willReturn($responseMock);
        $client = new Notifier();
        $client->setTransport($transport);

        $response = $client->notify($notifications);

        $expected = [
            [
                'id' => 138,
                'origin' => 'test',
                'recipient' => 'bobo',
                'event' => 'My best event',
                'message' => 'Last test',
                'type' => 1,
                'createdAt' => '2017-09-05T09:05:38+00:00',
                'status' => 1,
                'parent_notification_id' => null,
                'contexts' => '[]',
                'action' => '{"my.action": "first create"}',
            ],
            [
                'id' => 139,
                'origin' => 'super.test',
                'recipient' => 'toto',
                'event' => 'My favourite event',
                'message' => 'last test',
                'type' => 1,
                'createdAt' => '2017-09-05T09:05:38+00:00',
                'status' => 1,
                'parent_notification_id' => null,
                'contexts' => '[]',
                'action' => '{"my.second.action": "second create"}',
            ]
        ];

        $this->assertEquals($expected, $response);
    }

    public function testAlert()
    {

        $notification = new Notification([
                'id' => 139,
                'origin' => 'super.test',
                'recipient' => 'toto',
                'event' => 'My favourite event',
                'message' => 'last test',
                'type' => 1,
                'createdAt' => '2017-09-05T09:05:38+00:00',
                'status' => 1,
                'parent_notification_id' => null,
                'contexts' => '[]',
                'action' => '{"my.second.action": "second create"}',
            ]);


        $transport = $this->getMockBuilder(SyncTransportInterface::class)->getMock();
        $responseMock = $this->getMockBuilder(ResponseDescriptor::class)->setMethods(['getBody'])->getMock();
        $responseMock->expects($this->once())->method('getBody')->willReturn(json_encode(['done']));

        $transport->expects($this->once())->method('send')->willReturn($responseMock);
        $client = new Notifier();
        $client->setTransport($transport);

        $response = $client->alertEmail((new Email())->setContent('test')
        ->setSubject('test')->setEmail('contact@yoctu.com')->setNotification($notification));

        $this->assertEquals(['done'], $response);
    }

    public function testSend()
    {
        $responseDescriptor = $this->getMockBuilder(ResponseDescriptor::class)->getMock();

        /** @var Notifier $notifier */
        $notifier = Stub::make(Notifier::class, [
            'callSendInParent' => $responseDescriptor,
        ]);

        $request = new RequestDescriptor();
        $results = $notifier->send($request, 0);

        $this->assertEquals($responseDescriptor, $results);
    }

    public function testSendWhenAnExceptionIsThrownAndNoPrevious()
    {
        $notifier = Stub::make(Notifier::class, ['callSendInParent' => null]);
        $notifier->expects($this->once())->method('callSendInParent')->willThrowException(new \Exception('Error'));

        $request = new RequestDescriptor();

        $this->setExpectedException(NotificationException::class, 'Error');
        $notifier->send($request, 0);
    }

    public function testSendWhenNullIsReturned()
    {
        $notifier = Stub::make(Notifier::class, ['callSendInParent' => null]);
        $notifier->expects($this->once())->method('callSendInParent')->willReturn(true);

        $request = new RequestDescriptor();

        $results = $notifier->send($request, 0);

        $this->assertNull($results);
    }

    public function testSendWhenAnExceptionIsThrown()
    {
        $exception = new NotificationException('Error', 0);

        $notifier = Stub::make(Notifier::class, ['callSendInParent' => null]);
        $notifier->expects($this->once())->method('callSendInParent')->willThrowException($exception);

        $request = new RequestDescriptor();

        $this->setExpectedException(NotificationException::class, 'Error');
        $notifier->send($request, 0);
    }

    public function testMarkAsRead()
    {

        $transport = $this->getMockBuilder(SyncTransportInterface::class)->getMock();
        $responseMock = $this->getMockBuilder(ResponseDescriptor::class)->setMethods(['getBody'])->getMock();
        $responseMock->expects($this->once())->method('getBody')->willReturn(
            "{ \"updated\": [ {\"id\":113,\"origin\":\"super.test\",\"recipient\":\"toto\",
            \"event\":\"My favourite event\",\"message\":\"This is a new message 2\",
            \"type\":1,\"createdAt\":\"2017-09-04 12:41:01.000000\",\"status\":7,
            \"parent_notification_id\":null,\"contexts\":\"[]\",
            \"action\":\"{\\\"my.second.action\\\": \\\"second create\\\"}\"},{\"id\":115,\"origin\":\"super.test\",
            \"recipient\":\"toto\",\"event\":\"My favourite event\",
            \"message\":\"This is a new message 2\",\"type\":1,\"createdAt\":\"2017-09-04 12:41:01.000000\",
            \"status\":7,\"parent_notification_id\":null,\"contexts\":\"[]\",
            \"action\":\"{\\\"my.second.action\\\": \\\"second create\\\"}\"},
            {\"id\":117,\"origin\":\"super.test\",
            \"recipient\":\"toto\",\"event\":\"My favourite event\",
            \"message\":\"This is a new message 2\",\"type\":1,\"createdAt\":\"2017-09-04 12:41:01.000000\",
            \"status\":7,\"parent_notification_id\":null,
            \"contexts\":\"[]\",\"action\":\"{\\\"my.second.action\\\": \\\"second create\\\"}\"}]}"
        );

        $transport->expects($this->once())->method('send')->willReturn($responseMock);
        $client = new Notifier();
        $client->setTransport($transport);

        $response = $client->markAsRead(new SearchBuilder());

        $this->assertEquals($this->getCollection(), $response);
    }

    public function testMarkAsAcknowledged()
    {
        $transport = $this->getMockBuilder(SyncTransportInterface::class)->getMock();
        $responseMock = $this->getMockBuilder(ResponseDescriptor::class)->setMethods(['getBody'])->getMock();
        $responseMock->expects($this->once())->method('getBody')->willReturn(
            "{ \"updated\": [ {\"id\":113,\"origin\":\"super.test\",\"recipient\":\"toto\",
            \"event\":\"My favourite event\",\"message\":\"This is a new message 2\",
            \"type\":1,\"createdAt\":\"2017-09-04 12:41:01.000000\",\"status\":7,
            \"parent_notification_id\":null,\"contexts\":\"[]\",
            \"action\":\"{\\\"my.second.action\\\": \\\"second create\\\"}\"},{\"id\":115,\"origin\":\"super.test\",
            \"recipient\":\"toto\",\"event\":\"My favourite event\",
            \"message\":\"This is a new message 2\",\"type\":1,\"createdAt\":\"2017-09-04 12:41:01.000000\",
            \"status\":7,\"parent_notification_id\":null,\"contexts\":\"[]\",
            \"action\":\"{\\\"my.second.action\\\": \\\"second create\\\"}\"},
            {\"id\":117,\"origin\":\"super.test\",
            \"recipient\":\"toto\",\"event\":\"My favourite event\",
            \"message\":\"This is a new message 2\",\"type\":1,\"createdAt\":\"2017-09-04 12:41:01.000000\",
            \"status\":7,\"parent_notification_id\":null,
            \"contexts\":\"[]\",\"action\":\"{\\\"my.second.action\\\": \\\"second create\\\"}\"}]}"
        );

        $transport->expects($this->once())->method('send')->willReturn($responseMock);
        $client = new Notifier();
        $client->setTransport($transport);

        $response = $client->markAsAcknowledged(new SearchBuilder());

        $this->assertEquals($this->getCollection(), $response);
    }

    protected function getCollection()
    {
        return array (
            0 =>
                new Notification(array(
                    'id' => 113,
                    'origin' => 'super.test',
                    'recipient' => 'toto',
                    'event' => 'My favourite event',
                    'message' => 'This is a new message 2',
                    'type' => 1,
                    'createdAt' => '2017-09-04 12:41:01.000000',
                    'status' => 7,
                    'parent_notification_id' => null,
                    'contexts' => '[]',
                    'action' => '{"my.second.action": "second create"}',
                )),
            1 =>
                new Notification(array(
                    'id' => 115,
                    'origin' => 'super.test',
                    'recipient' => 'toto',
                    'event' => 'My favourite event',
                    'message' => 'This is a new message 2',
                    'type' => 1,
                    'createdAt' => '2017-09-04 12:41:01.000000',
                    'status' => 7,
                    'parent_notification_id' => null,
                    'contexts' => '[]',
                    'action' => '{"my.second.action": "second create"}',
                )),
            2 =>
                new Notification(array(
                    'id' => 117,
                    'origin' => 'super.test',
                    'recipient' => 'toto',
                    'event' => 'My favourite event',
                    'message' => 'This is a new message 2',
                    'type' => 1,
                    'createdAt' => '2017-09-04 12:41:01.000000',
                    'status' => 7,
                    'parent_notification_id' => null,
                    'contexts' => '[]',
                    'action' => '{"my.second.action": "second create"}',
                ))
        );
    }
}
