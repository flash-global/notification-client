<?php

namespace Fei\Service\Notification\Client\Entity\Alert;

use Fei\Service\Notification\Client\Entity\Alert\Android\Message;

/**
 * Class Android
 *
 * @package Fei\Service\Notification\Entity\Alert
 */
class Android extends AbstractAlert
{
    /**
     * @var Message
     */
    protected $message;

    /**
     * Get Message
     *
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set Message
     *
     * @param Message $message
     *
     * @return self
     */
    public function setMessage(Message $message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return 'android-push';
    }

    /**
     * @param $data
     *
     * @return $this
     *
     * @throws \Fei\Entity\Exception
     */
    public function hydrate($data)
    {
        $pushNotification = (!empty($data['message']['notification'])) ?
            new Android\Notification($data['message']['notification']) :
            new Android\Notification();
        $data['message']['notification'] = $pushNotification;
        $data['message'] = (new Android\Message($data['message']));

        return parent::hydrate($data);
    }
}
