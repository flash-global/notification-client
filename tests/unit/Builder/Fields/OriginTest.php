<?php


namespace Tests\Fei\Service\Notification\Client\Builder\Fields;

use Codeception\Test\Unit;
use Fei\Service\Notification\Client\Builder\Fields\Origin;
use Fei\Service\Notification\Client\Builder\SearchBuilder;

class OriginTest extends Unit
{

    public function testEvent()
    {
        $builder = new SearchBuilder();
        $category = new Origin($builder);

        $category->build('my.service');

        $this->assertAttributeEquals([
            'origin' => [
                'value' => 'my.service',
                'operator' => '='
            ]
        ], 'params', $builder);
    }
}
