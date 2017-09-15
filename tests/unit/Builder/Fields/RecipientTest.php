<?php


namespace Tests\Fei\Service\Notification\Client\Builder\Fields;

use Codeception\Test\Unit;
use Fei\Service\Notification\Client\Builder\Fields\Recipient;
use Fei\Service\Notification\Client\Builder\SearchBuilder;

class RecipientTest extends Unit
{

    public function testEvent()
    {
        $builder = new SearchBuilder();
        $category = new Recipient($builder);

        $category->build('toto');

        $this->assertAttributeEquals([
            'recipient' => [
                'value' => 'toto',
                'operator' => '='
            ]
        ], 'params', $builder);
    }
}
