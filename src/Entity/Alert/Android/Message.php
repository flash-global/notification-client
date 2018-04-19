<?php

namespace Fei\Service\Notification\Client\Entity\Alert\Android;

use Fei\Entity\AbstractEntity;

/**
 * Class Message
 *
 * @package Fei\Service\Notification\Entity\Alert\Android
 *
 */
class Message extends AbstractEntity
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var Notification
     */
    protected $notification;

    /**
     * @var string
     */
    protected $token = '';

    /**
     * @var string
     */
    protected $topic = '';

    /**
     * @var string
     */
    protected $condition= '';

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return Message
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }

    /**
     * @param Notification $notification
     * @return Message
     */
    public function setNotification(Notification $notification)
    {
        $this->notification = $notification;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Message
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param string $topic
     * @return Message
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
        return $this;
    }

    /**
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param string $condition
     * @return Message
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
        return $this;
    }

    public function toArray($mapped = false)
    {
        $arr = parent::toArray($mapped);

        if ($arr['notification'] instanceof Notification) {
            $arr['notification'] = $arr['notification']->toArray();
        }

        return $arr;
    }
}
