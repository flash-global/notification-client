<?php


namespace Tests\Fei\Service\Notification\Client\Builder\Fields;

use Codeception\Test\Unit;
use Fei\Service\Notification\Client\Builder\Fields\Event;
use Fei\Service\Notification\Client\Builder\SearchBuilder;

class EventTest extends Unit
{

    public function testEvent()
    {
        $builder = new SearchBuilder();
        $category = new Event($builder);

        $category->build('new.message');

        $this->assertAttributeEquals([
            'event' => [
                'value' => 'new.message',
                'operator' => '='
            ]
        ], 'params', $builder);
    }
}
