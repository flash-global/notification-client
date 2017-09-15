<?php
namespace Fei\Service\Notification\Client\Builder\Fields;

use Fei\Service\Notification\Client\Builder\OperatorBuilder;

/**
 * Class Type
 * @package Fei\Service\Notification\Client\Builder\Fields
 */
class Type extends OperatorBuilder
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
        $search['type']['value'] = $value;
        $search['type']['operator'] = (isset($operator)) ? $operator : '=';

        $this->builder->setParams($search);
    }
}
