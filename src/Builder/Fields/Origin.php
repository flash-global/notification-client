<?php
namespace Fei\Service\Notification\Client\Builder\Fields;

use Fei\Service\Notification\Client\Builder\OperatorBuilder;

/**
 * Class Origin
 * @package Fei\Service\Notification\Client\Builder\Fields
 */
class Origin extends OperatorBuilder
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
        $search['origin']['value'] = $value;
        $search['origin']['operator'] = (isset($operator)) ? $operator : '=';

        $this->builder->setParams($search);
    }
}
