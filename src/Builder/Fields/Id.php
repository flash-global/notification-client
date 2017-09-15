<?php
namespace Fei\Service\Notification\Client\Builder\Fields;

use Fei\Service\Notification\Client\Builder\OperatorBuilder;

/**
 * Class Id
 * @package Fei\Service\Notification\Client\Builder\Fields
 */
class Id extends OperatorBuilder
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
        $search['id']['value'] = $value;
        $search['id']['operator'] = (isset($operator)) ? $operator : '=';

        $this->builder->setParams($search);
    }
}
