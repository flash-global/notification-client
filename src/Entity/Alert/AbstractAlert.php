<?php

namespace Fei\Service\Notification\Client\Entity\Alert;

use Fei\Entity\AbstractEntity;
use Fei\Service\Notification\Client\Entity\Notification;

/**
 * Class AbstractAlert
 * @package Fei\Service\Notification\Client\Entity\Alert
 */
abstract class AbstractAlert extends AbstractEntity
{
    /**
     * @var Notification
     */
    protected $notification;

    /**
     * @var int
     */
    protected $trigger = 0;

    /**
     * @return Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param $notification
     * @return $this
     */
    public function setNotification(Notification $notification)
    {
        $this->notification = $notification;
        return $this;
    }

    /**
     * @return int
     */
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * @param int $trigger a number of minutes
     * @return $this
     */
    public function setTrigger($trigger = 0)
    {
        $this->trigger = $trigger;

        return $this;
    }

    /**
     * @param bool $mapped
     * @return array
     */
    public function toArray($mapped = false)
    {
        $arr = parent::toArray($mapped);

        if ($arr['notification'] instanceof Notification) {
            $arr['notification'] = $arr['notification']->toArray();
        }

        return $arr;
    }

    /**
     * Get the type of the alert (email, sms, etc.)
     *
     * @return string
     */
    abstract public function getType();
}
