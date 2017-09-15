<?php


namespace Tests\Fei\Service\Notification\Client\Builder\Fields;

use Codeception\Test\Unit;
use Fei\Service\Notification\Client\Builder\Fields\Status;
use Fei\Service\Notification\Client\Builder\SearchBuilder;

class StatusTest extends Unit
{

    public function testEvent()
    {
        $builder = new SearchBuilder();
        $category = new Status($builder);

        $category->build(1);

        $this->assertAttributeEquals([
            'status' => [
                'value' => 1,
                'operator' => '='
            ]
        ], 'params', $builder);
    }
}
