<?php

namespace Tests\Fei\Service\Notification\Client\Builder;

use Codeception\Test\Unit;
use Fei\Service\Notification\Client\Builder\Fields\Context;
use Fei\Service\Notification\Client\Builder\Fields\Event;
use Fei\Service\Notification\Client\Builder\Fields\Id;
use Fei\Service\Notification\Client\Builder\Fields\Message;
use Fei\Service\Notification\Client\Builder\Fields\Origin;
use Fei\Service\Notification\Client\Builder\Fields\Recipient;
use Fei\Service\Notification\Client\Builder\Fields\Status;
use Fei\Service\Notification\Client\Builder\Fields\Type;
use Fei\Service\Notification\Client\Builder\SearchBuilder;
use Fei\Service\Notification\Client\Exception\NotificationException;

class SearchBuilderTest extends Unit
{

    public function testRecipient()
    {
        $builder = new SearchBuilder();

        $expected = $builder->recipient();

        $this->assertInstanceOf(Recipient::class, $expected);
        $this->assertAttributeEquals($builder, 'builder', $expected);
    }

    public function testEvent()
    {
        $builder = new SearchBuilder();

        $expected = $builder->event();

        $this->assertInstanceOf(Event::class, $expected);
        $this->assertAttributeEquals($builder, 'builder', $expected);
    }

    public function testMessage()
    {
        $builder = new SearchBuilder();

        $expected = $builder->message();

        $this->assertInstanceOf(Message::class, $expected);
        $this->assertAttributeEquals($builder, 'builder', $expected);
    }

    public function testContext()
    {
        $builder = new SearchBuilder();

        $expected = $builder->context();

        $this->assertInstanceOf(Context::class, $expected);
        $this->assertAttributeEquals($builder, 'builder', $expected);
    }

    public function testContextConditionWhenTypeIsNotValid()
    {
        $builder = new SearchBuilder();

        $this->expectException(NotificationException::class);
        $this->expectExceptionMessage('Type has to be either "AND" or "OR"!');

        $builder->contextCondition('ERR');
    }

    public function testContextConditionWhenTypeIsValid()
    {
        $builder = new SearchBuilder();
        $builder->contextCondition('OR');

        $this->assertEquals([
            'context_condition' => 'OR'
        ], $builder->getParams());
    }

    public function testStatus()
    {
        $builder = new SearchBuilder();

        $expected = $builder->status();

        $this->assertInstanceOf(Status::class, $expected);
        $this->assertAttributeEquals($builder, 'builder', $expected);
    }

    public function testType()
    {
        $builder = new SearchBuilder();

        $expected = $builder->type();

        $this->assertInstanceOf(Type::class, $expected);
        $this->assertAttributeEquals($builder, 'builder', $expected);
    }

    public function testId()
    {
        $builder = new SearchBuilder();

        $expected = $builder->id();

        $this->assertInstanceOf(Id::class, $expected);
        $this->assertAttributeEquals($builder, 'builder', $expected);
    }

    public function testOrigin()
    {
        $builder = new SearchBuilder();

        $expected = $builder->origin();

        $this->assertInstanceOf(Origin::class, $expected);
        $this->assertAttributeEquals($builder, 'builder', $expected);
    }

    public function testParamsAccessors()
    {
        $builder = new SearchBuilder();
        $builder->setParams(['a' => 'b']);
        $this->assertEquals(['a' => 'b'], $builder->getParams());
        $this->assertAttributeEquals($builder->getParams(), 'params', $builder);
    }

    public function testToCamelCase()
    {
        $builder = new SearchBuilder();
        $this->assertEquals('HelloWorld', $builder->toCamelCase('hello_world'));
        $this->assertEquals('HelloWorld', $builder->toCamelCase('helloWorld'));
    }

    public function testCallMagicMethod()
    {
        $builder = new SearchBuilder();

        $this->assertInstanceOf(Origin::class, $builder->__call('origin', null));
        $this->expectException(\Exception::class);
        $builder->fakeMethode();
    }
}
