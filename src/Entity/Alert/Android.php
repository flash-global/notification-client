<?php


namespace Fei\Service\Notification\Client\Entity\Alert;

use Fei\Service\Notification\Client\Entity\Alert\Android\Message;

/**
 * Class Android
 * @package Fei\Service\Notification\Client\Entity\Alert
 */
class Android extends AbstractAlert
{
    /**
     * @var Message
     */
    protected $message;

    /**
     * @return Message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function getAndroidNotification()
    {
        return $this->getMessage()->toArray();
    }

    /**
     * @inheritdoc
     */
    public function getType()
    {
        return 'android-push';
    }

    /**
     * @param array|\ArrayObject|\Traversable $data
     * @return $this
     */
    public function hydrate($data)
    {
        $pushNotification = (!empty($data['message']['pushNotification'])) ?
            new Android\PushNotification($data['message']['pushNotification']) :
            new Android\PushNotification();
        $data['message']['pushNotification'] = $pushNotification;
        $data['message'] = (new Android\Message($data['message']));

        return parent::hydrate($data);
    }
}
