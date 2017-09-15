<?php
namespace Fei\Service\Notification\Client\Builder\Fields;

use Fei\Service\Notification\Client\Builder\OperatorBuilder;

/**
 * Class Recipient
 * @package Fei\Service\Notification\Client\Builder\Fields
 */
class Recipient extends OperatorBuilder
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
        $search['recipient']['value'] = $value;
        $search['recipient']['operator'] = (isset($operator)) ? $operator : '=';

        $this->builder->setParams($search);
    }
}
