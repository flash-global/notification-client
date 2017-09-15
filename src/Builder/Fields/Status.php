<?php
namespace Fei\Service\Notification\Client\Builder\Fields;

use Fei\Service\Notification\Client\Builder\OperatorBuilder;

/**
 * Class Status
 * @package Fei\Service\Notification\Client\Builder\Fields
 */
class Status extends OperatorBuilder
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
        $search['status']['value'] = $value;
        $search['status']['operator'] = (isset($operator)) ? $operator : '=';

        $this->builder->setParams($search);
    }
}
