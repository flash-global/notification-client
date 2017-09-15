<?php


namespace Fei\Service\Notification\Client\Entity\Alert\Sms;

use Fei\Entity\AbstractEntity;

/**
 * Class Message
 * @package Fei\Service\Notification\Client\Entity\Alert\Sms
 */
class Message extends AbstractEntity
{
    /**
     * @var string
     */
    protected $from;

    /**
     * @var array
     */
    protected $recipients;

    /**
     * content of sms
     * @var string
     */
    protected $content;

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param string $from
     * @return $this
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @param array $recipients
     * @return $this
     */
    public function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @param string $number
     * @return Message
     */
    public function addRecipient($number)
    {
        $this->recipients[] = $number;
        return $this;
    }
}
