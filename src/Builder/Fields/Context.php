<?php
namespace Fei\Service\Notification\Client\Builder\Fields;

use Fei\Service\Notification\Client\Builder\OperatorBuilder;

class Context extends OperatorBuilder
{
    public function build($value, $operator = null)
    {
        $search = $this->builder->getParams();
        $search['contexts'][] = [
            'key' => $this->getInCache(),
            'value' => $value,
            'operator' => $operator
        ];

        $this->builder->setParams($search);
    }

    public function key($key)
    {
        $this->setInCache($key);
        return $this;
    }
}
