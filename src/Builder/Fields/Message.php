<?php
namespace Fei\Service\Notification\Client\Builder\Fields;

use Fei\Service\Notification\Client\Builder\OperatorBuilder;

/**
 * Class Message
 * @package Fei\Service\Notification\Client\Builder\Fields
 */
class Message extends OperatorBuilder
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
        $search['message']['value'] = $value;
        $search['message']['operator'] = (isset($operator)) ? $operator : '=';

        $this->builder->setParams($search);
    }
}
