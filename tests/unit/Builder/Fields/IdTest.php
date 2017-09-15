<?php


namespace Tests\Fei\Service\Notification\Client\Builder\Fields;

use Codeception\Test\Unit;
use Fei\Service\Notification\Client\Builder\Fields\Id;
use Fei\Service\Notification\Client\Builder\SearchBuilder;

class IdTest extends Unit
{

    public function testEvent()
    {
        $builder = new SearchBuilder();
        $category = new Id($builder);

        $category->build(1);

        $this->assertAttributeEquals([
            'id' => [
                'value' => 1,
                'operator' => '='
            ]
        ], 'params', $builder);
    }
}
