<?php
namespace Fei\Service\Notification\Client\Builder\Fields;

use Fei\Service\Notification\Client\Builder\OperatorBuilder;

/**
 * Class Event
 * @package Fei\Service\Notification\Client\Builder\Fields
 */
class Event extends OperatorBuilder
{
    /**
     * @param $value
     *
     * @param null $operator
     * @return mixed|void
     */
    public function build($value, $operator = null)
    {
        $search = $this->builder->getParams();
        $search['event']['value'] = $value;
        $search['event']['operator'] = (isset($operator)) ? $operator : '=';

        $this->builder->setParams($search);
    }
}
