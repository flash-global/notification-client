<?php

namespace Fei\Service\Notification\Client\Entity\Alert\Android;

use Fei\Service\Notification\Client\Entity\Alert\Android\Exception\AndroidPushException;

/**
 * Class Message
 *
 * https://developers.google.com/cloud-messaging/http-server-ref#downstream-http-messages-json
 *
 * @package Fei\Service\Notification\Entity\Alert\Android
 *
 * @SuppressWarnings(PHPMD.LongVariable)
 */
class Message extends AbstractAndroid
{
    const PRIORITY_HIGH = 'high';
    const PRIORITY_NORMAL = 'normal';

    /**
     * @var array
     */
    protected $recipients;

    /**
     * @var string
     */
    protected $collapseKey;

    /**
     * @var string
     */
    protected $priority = self::PRIORITY_HIGH;

    /**
     * value in seconds : max = 4 week = default, check the doc
     *
     * @var int
     */
    protected $timeToLive = 2419200;

    /**
     * @var string
     */
    protected $restrictedPackageName;

    /**
     * @var bool
     */
    protected $dryRun;

    /**
     * @var PushNotification
     */
    protected $pushNotification;

    /**
     * Get Recipients
     *
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * Set Recipients
     *
     * @param array $recipients
     * @return $this
     */
    public function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * Get CollapseKey
     *
     * @return string
     */
    public function getCollapseKey()
    {
        return $this->collapseKey;
    }

    /**
     * Set CollapseKey
     *
     * @param $collapseKey
     * @return $this
     */
    public function setCollapseKey($collapseKey)
    {
        $this->collapseKey = $collapseKey;
        return $this;
    }

    /**
     * Get Priority
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set Priority
     *
     * @param $priority
     * @return $this
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * Get TimeToLive
     *
     * @return int
     */
    public function getTimeToLive()
    {
        return $this->timeToLive;
    }

    /**
     * Set TimeToLive
     *
     * @param $timeToLive
     * @return $this
     */
    public function setTimeToLive($timeToLive)
    {
        $this->timeToLive = $timeToLive;
        return $this;
    }

    /**
     * Get RestrictedPackageName
     *
     * @return string
     */
    public function getRestrictedPackageName()
    {
        return $this->restrictedPackageName;
    }

    /**
     * Set RestrictedPackageName
     *
     * @param $restrictedPackageName
     * @return $this
     */
    public function setRestrictedPackageName($restrictedPackageName)
    {
        $this->restrictedPackageName = $restrictedPackageName;
        return $this;
    }

    /**
     * Get DryRun
     *
     * @return bool
     */
    public function isDryRun()
    {
        return $this->dryRun;
    }

    /**
     * Set DryRun
     *
     * @param $dryRun
     * @return $this
     */
    public function setDryRun($dryRun)
    {
        $this->dryRun = $dryRun;
        return $this;
    }

    /**
     * Get Notification
     *
     * @return PushNotification
     */
    public function getPushNotification()
    {
        return $this->pushNotification;
    }

    /**
     * Set Notification
     *
     * @param PushNotification $pushNotification
     * @return $this
     */
    public function setPushNotification(PushNotification $pushNotification)
    {
        $this->pushNotification = $pushNotification;
        return $this;
    }

    /**
     * Add Recipient
     *
     * @param $token
     * @return $this
     */
    public function addRecipient($token)
    {
        $this->recipients[] = $token;
        return $this;
    }

    /**
     * @return array
     * @throws AndroidPushException
     */
    public function buildArray()
    {
        $data = [];
        $vars = get_object_vars($this);

        if (empty($this->getRecipients())) {
            throw new AndroidPushException('The recipient can\'t be null');
        }

        foreach ($vars as $key => $value) {
            if (!empty($value)) {
                switch ($key) {
                    case 'recipients':
                        $this->formatRecipients($data);
                        break;
                    case 'pushNotification':
                        $data['notification'] = $this->getPushNotification()->buildArray();
                        break;
                    default:
                        $attr = $this->toSnakeCase($key);
                        $data[$attr] = $value;
                        break;
                }
            }
        }

        return $data;
    }

    /**
     * @param array $data
     */
    private function formatRecipients(array &$data)
    {
        if (count($this->getRecipients()) === 1) {
            $data['to'] = $this->getRecipients()[0];
        } else {
            $data['registration_ids'] = $this->getRecipients();
        }
    }
}
