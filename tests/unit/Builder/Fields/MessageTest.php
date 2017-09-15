<?php


namespace Tests\Fei\Service\Notification\Client\Builder\Fields;

use Codeception\Test\Unit;
use Fei\Service\Notification\Client\Builder\Fields\Message;
use Fei\Service\Notification\Client\Builder\SearchBuilder;

class MessageTest extends Unit
{

    public function testEvent()
    {
        $builder = new SearchBuilder();
        $category = new Message($builder);

        $category->build('my message');

        $this->assertAttributeEquals([
            'message' => [
                'value' => 'my message',
                'operator' => '='
            ]
        ], 'params', $builder);
    }
}
