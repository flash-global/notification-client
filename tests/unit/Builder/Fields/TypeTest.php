<?php


namespace Tests\Fei\Service\Notification\Client\Builder\Fields;

use Codeception\Test\Unit;
use Fei\Service\Notification\Client\Builder\Fields\Type;
use Fei\Service\Notification\Client\Builder\SearchBuilder;

class TypeTest extends Unit
{

    public function testEvent()
    {
        $builder = new SearchBuilder();
        $category = new Type($builder);

        $category->build(1);

        $this->assertAttributeEquals([
            'type' => [
                'value' => 1,
                'operator' => '='
            ]
        ], 'params', $builder);
    }
}
