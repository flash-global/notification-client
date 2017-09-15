<?php

namespace Tests\Fei\Service\Notification\Client\Builder\Fields;

use Codeception\Test\Unit;
use Fei\Service\Notification\Client\Builder\Fields\Context;
use Fei\Service\Notification\Client\Builder\OperatorBuilder;
use Fei\Service\Notification\Client\Builder\SearchBuilder;

class ContextTest extends Unit
{
    public function testBuild()
    {
        $contexts = [
            'contexts' => [
                [
                    'value' => 'fake',
                    'operator' => '=',
                    'key' => 'my_key'
                ]
            ]
        ];

        $builder = new SearchBuilder();
        $context = new Context($builder);
        $context->key('my_key');
        $context->build('fake', '=');
        $this->assertAttributeEquals($contexts, 'params', $builder);
    }

    public function testKey()
    {
        $builder = new SearchBuilder();
        $context = new Context($builder);
        $res = $context->key('my_key');
        $this->assertEquals('my_key', $context->getInCache());
        $this->assertInstanceOf(OperatorBuilder::class, $res);
    }
}
