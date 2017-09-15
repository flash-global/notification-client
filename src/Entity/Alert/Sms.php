<?php


namespace Fei\Service\Notification\Client\Entity\Alert;

use Fei\Service\Notification\Client\Entity\Alert\Sms\Message;

/**
 * Class Sms
 * @package Fei\Service\Notification\Client\Entity\Alert
 */
class Sms extends AbstractAlert
{
    /**
     * @var Message[]
     */
    protected $messages = [];

    /**
     * @return Message[]
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param $messages
     * @return $this
     */
    public function setMessages($messages)
    {
        $messages = func_get_args();
        foreach ($messages as $message) {
            $this->messages[] = $message;
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return 'sms';
    }
}
