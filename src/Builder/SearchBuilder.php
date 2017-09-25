<?php
namespace Fei\Service\Notification\Client\Builder;

use Fei\Service\Notification\Client\Builder\Fields\Context;
use Fei\Service\Notification\Client\Builder\Fields\Event;
use Fei\Service\Notification\Client\Builder\Fields\Id;
use Fei\Service\Notification\Client\Builder\Fields\Message;
use Fei\Service\Notification\Client\Builder\Fields\Origin;
use Fei\Service\Notification\Client\Builder\Fields\Recipient;
use Fei\Service\Notification\Client\Builder\Fields\Status;
use Fei\Service\Notification\Client\Builder\Fields\Type;
use Fei\Service\Notification\Client\Exception\NotificationException;

class SearchBuilder
{
    protected $params = [];

    const NAMESPACE_FIELDS = 'Fei\Service\Notification\Client\Builder\Fields\\';

    /**
     * @return Recipient
     */
    public function recipient()
    {
        return new Recipient($this);
    }

    /**
     * @return Event
     */
    public function event()
    {
        return new Event($this);
    }


    /**
     * @return Message
     */
    public function message()
    {
        return new Message($this);
    }

    /**
     * @return Status
     */
    public function status()
    {
        return new Status($this);
    }

    /**
     * @return Type
     */
    public function type()
    {
        return new Type($this);
    }

    /**
     * @return Id
     */
    public function id()
    {
        return new Id($this);
    }

    /**
     * @return Origin
     */
    public function origin()
    {
        return new Origin($this);
    }

    /**
     * Set the condition type for the contexts
     *
     * @param string $type
     *
     * @return $this
     */
    public function contextCondition($type = 'AND')
    {
        $type = strtoupper($type);

        if (!in_array($type, ['AND', 'OR'])) {
            throw new NotificationException('Type has to be either "AND" or "OR"!');
        }

        $params = $this->getParams();
        $params['context_condition'] = $type;

        $this->setParams($params);
    }

    /**
     * Add a filter the the contexts
     *
     * @return Context
     */
    public function context()
    {
        return new Context($this);
    }

    /**
     * Get Params
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set Params
     *
     * @param array $params
     *
     * @return $this
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }
    
    public function __call($name, $arguments)
    {
        $class = static::NAMESPACE_FIELDS . ucfirst($this->toCamelCase($name));

        if (class_exists($class)) {
            return new $class($this);
        } else {
            throw new \Exception("Cannot load " . $name . ' filter!');
        }
    }

    /**
     * @param $offset
     *
     * @return string
     */
    public function toCamelCase($offset)
    {
        $parts = explode('_', $offset);
        array_walk($parts, function (&$offset) {
            $offset = ucfirst($offset);
        });

        return implode('', $parts);
    }
}
