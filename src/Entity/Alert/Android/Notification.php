<?php

namespace Fei\Service\Notification\Client\Entity\Alert\Android;

use Fei\Entity\AbstractEntity;

/**
 * Class Notification
 * @package Fei\Service\Notification\Entity\Alert\Android
 */
class Notification extends AbstractEntity
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $body;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Notification
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Notification
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }
}
